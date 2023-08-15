FROM node:18 as dev

WORKDIR /app/

VOLUME "/app"

CMD ["npm", "run", "dev"]

FROM node:18 as prod

WORKDIR /app/
COPY ./ /app/

RUN npm install
RUN npm run build

CMD ["npm", "start"]





