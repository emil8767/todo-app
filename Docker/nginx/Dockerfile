FROM nginx

ARG WEB_USER_ID=1000
ARG WEB_USER_NAME=dev
RUN useradd -m -u ${WEB_USER_ID} ${WEB_USER_NAME} || echo "User exists, it's ok." \
    && sed -i -- "s/user nginx;/user ${WEB_USER_NAME};/" /etc/nginx/nginx.conf

COPY templates /etc/nginx/templates
