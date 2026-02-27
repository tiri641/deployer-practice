FROM ubuntu:20.04

# タイムゾーンの設定（apt-get中に止まらないようにする）
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Asia/Tokyo

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    openssh-server \
    php \
    git \
    && rm -rf /var/lib/apt/lists/*

# SSHの設定
RUN mkdir /var/run/sshd

# deployerユーザーの作成
RUN useradd -m -s /bin/bash deployer
RUN mkdir -p /home/deployer/.ssh
RUN chmod 700 /home/deployer/.ssh

# 公開鍵をコンテナにコピー
COPY authorized_keys /home/deployer/.ssh/authorized_keys
RUN chmod 600 /home/deployer/.ssh/authorized_keys
RUN chown -R deployer:deployer /home/deployer/.ssh

# デプロイ先ディレクトリの作成
RUN mkdir -p /home/deployer/my-app
RUN chown -R deployer:deployer /home/deployer/my-app

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]
