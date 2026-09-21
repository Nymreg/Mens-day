#!/bin/sh
set -eu

if [ "${1:-}" = 'apache2-foreground' ]; then
    # Render mounts this file only at runtime. Do not chmod the mounted secret.
    ca_source=${DB_SSL_CA:-/etc/secrets/ca.pem}
    ca_target=/var/run/app-secrets/ca.pem
    if [ "$(id -u)" != '0' ]; then
        echo 'CA setup failed: container startup must run as root.' >&2
        exit 1
    fi
    if [ ! -f "$ca_source" ] || [ ! -r "$ca_source" ] || [ ! -s "$ca_source" ]; then
        echo 'CA setup failed: mounted certificate is missing, empty, or unreadable.' >&2
        exit 1
    fi
    umask 077
    install -d -o root -g www-data -m 0750 /var/run/app-secrets
    install -o root -g www-data -m 0640 "$ca_source" "$ca_target"
    su -s /bin/sh www-data -c 'test -r /var/run/app-secrets/ca.pem' || {
        echo 'CA setup failed: Apache cannot read the runtime certificate.' >&2
        exit 1
    }
    # Apache and PHP inherit this path; Render's configured source stays unchanged.
    export DB_SSL_CA="$ca_target"
    echo 'CA setup complete: runtime certificate is readable by www-data.' >&2
    apache2ctl -t
fi

exec docker-php-entrypoint "$@"
