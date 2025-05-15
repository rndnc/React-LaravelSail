FROM node:18-alpine
WORKDIR /app
COPY package.json package-lock.json ./
# npm依存関係をインストール
RUN npm install
COPY . .
CMD ["npm", "run", "dev"]

