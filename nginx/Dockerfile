FROM nginx:alpine

ARG UID

RUN apk add --no-cache coreutils sudo mc bash

# Add user with superuser privileges
ENV USER appuser
RUN adduser --disabled-password -u $UID $USER \
 && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
 && chmod 0440 /etc/sudoers.d/$USER
