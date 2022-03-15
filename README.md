#  lsky-pro-docker

## 说明

- 原作者：https://github.com/lsky-org/lsky-pro
- **现已支持至：2.0**
- PHP 8.1-apache
- PHP上传限制已修改为：100M，可自行修改，在Dockerfile 29行
- 新增文件：`Dockerfile`、`000-default.conf`、`entrypoint.sh`。
- 以后小版本更新将不会在这里更新，只会在hub.docker.com中更新。

## 使用

```sh
docker run -it -name=lsky-pro2.0 -v lsky-data:/var/www/html -p 8080:80 zyugat/lskypro:2.0
```

