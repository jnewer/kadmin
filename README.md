# webman skeleton

## 安装步骤

1.克隆仓库`git clone https://github.com/jnewer/kadmin.git myapp`
2.进入项目目录`cd myapp`，安装依赖`composer install`
3.复制配置文件`cp .env.example .env`
4.修改 .env 文件中的数据库配置，新建数据库
5.执行数据库迁移`php webman migrate:run`
6.初始化管理员账号`php webman seed:run`
7.运行服务`php webman start`
