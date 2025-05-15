import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'; 
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            //input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // typescriptとsassが使えるように変更
            input: [
                'resources/sass/app.sass', 
                'resources/ts/index.tsx'
            ],
            // public/hot ディレクトリをファイルとして扱うための設定
            hot: false,
        }),
        react(),
    ],
    resolve: {
        alias: {
            // Bootstrap のパスエイリアスを追加
            'bootstrap': path.resolve(__dirname, 'react-app/node_modules/bootstrap')
        }
    },
    server: {
        proxy: {
            '/api': {
                target: 'http://localhost:80',
                changeOrigin: true,
                secure: false
            }
        }
    }
});