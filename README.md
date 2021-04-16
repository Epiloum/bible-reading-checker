# 대길교회 성경읽기표

## 소개
성경읽기표는 <a href="http://www.daegil.net">대길교회</a> 청년부에서 2021년 성경통독 캠페인을 위하여 만들어진 웹서비스입니다. 

## 로컬 개발환경

### 세팅방법

※ 먼저 본 설명에서 "최상위 경로"라 할 때에는 본 md 파일이 위치한 디렉토리를 의미한다는 것을 우선 기재해둡니다.

로컬 개발환경 구동을 위해서는 docker-compose 명령어를 사용 가능해야 하고, 최상위 경로에 docker-compose.override.yml, .env의 2개 파일이 있어야 합니다. 두 파일은 모두 .gitignore로 등록되어 있으므로 git으로는 받을 수 없으며, epiloum에게 별도 요청하거나 직접 구축해야 합니다.

두 파일이 세팅이 되면, docker-compose.yml 파일이 있는 경로에서 다음과 같이 docker-compose 명령어로 로컬환경을 구동할 수 있습니다.

```
# docker-compose up -d
```

DB Table의 생성과 초기 데이터 입력은 Laravel migration과 seeder를 통해 진행합니다. 이 명령어는 구동된 Docker Container 중에서 bible-reading-php의 CLI에서 최상위 경로로 진입하여 실행해야 합니다. (설정의 변화가 없다면 보통 최상위 경로는 /var/www입니다.) 

```
# cd /var/www
# php artisan migrate:refresh --seed
```

### 유의점

본 소스코드에는 로컬 실행시에 SNS 로그인을 우회하여, users 테이블의 첫 번째 레코드를 가져와 인증하는 로직이 담겨 있습니다. 따라서 users 테이블이 존재하지 않거나 비어있으면 로컬에서 오류가 발생합니다. 이 때는 migration과 seed를 다시 진행하여 바로잡아야 합니다.   
