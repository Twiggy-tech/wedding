# Stage 1: Build
FROM node:18 as build
WORKDIR /app
RUN npm init -y
COPY vue/package*.json ./
RUN npm install
RUN npm install axios vue-router@4 sass bootstrap @popperjs/core bootstrap-icons pinia
COPY vue/ .
RUN npm run build

# Stage 2: Serve
FROM nginx:alpine
COPY --from=build /app/dist /usr/share/nginx/html
COPY docker/vue/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
