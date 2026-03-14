FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Asia/Tokyo

RUN apt-get update && apt-get install -y \
    openssh-server \
    php \
    php-fpm \
    nginx \
    git \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir /var/run/sshd

RUN useradd -m -s /bin/bash deployer
RUN mkdir -p /home/deployer/.ssh
RUN chmod 700 /home/deployer/.ssh

COPY authorized_keys /home/deployer/.ssh/authorized_keys
RUN chmod 600 /home/deployer/.ssh/authorized_keys
RUN chown -R deployer:deployer /home/deployer/.ssh

RUN mkdir -p /home/deployer/my-app
RUN chown -R deployer:deployer /home/deployer/my-app

# Nginxの設定ファイルをコピー
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 22 80

# SSHとNginxとPHP-FPMを同時に起動
CMD service php7.4-fpm start && service nginx start && /usr/sbin/sshd -D