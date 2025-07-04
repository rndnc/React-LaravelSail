# プロジェクト名
商品販売管理システム

## 概要
商品管理を目的としたWebアプリケーションです。  
Laravel SailとReactを用いてDocker環境で自己開発しました。  
ログイン・商品一覧・検索・詳細表示・登録・編集・削除など一連のCRUD機能を実装しています。  

## 開発目的  
バックエンドとフロントエンドを分離した構成を理解・実践するため、商品管理システムを開発いたしました。  

## 開発方針
本プロジェクトでは以下の開発指針に基づき、品質と開発効率の向上を目指しています。

- **Laravel SailとReactをDockerで統合**  
  Laravel Sail（バックエンド）とReact（フロントエンド）をDocker環境で統合し、ローカル環境の差異なくしています。
  これにより、環境構築の手間を減らし、チーム全体で一貫した開発環境を維持しています。

- **シングルアクションコントローラーの採用**  
  コントローラーは単一責務のシングルアクションとして設計し、各処理を個別のクラスに分割しています。  
  これにより、コントローラーの肥大化を防ぎ、メンテナンス性を高めています。

- **モダンPHPの静的型付け**  
  各PHPファイルに `declare(strict_types=1);` を記述し、厳密な型チェックを実施しています。  
  これにより、型関連のバグを未然に防ぎ、安全なコードの実現を目指しています。

- **ORM（Eloquent）を活用したモデル操作**  
  モデルへのアクセスはLaravelのEloquent ORMを用い、基本クエリビルダを使わずにデータ操作を行いました。 
  これにより、コードの可読性・保守性が向上しております。

-------------------------------------------------------------

## 機能一覧

- 認証機能  
  - 新規登録  
  - ログイン  

- Top画面（商品一覧画面）  
  - 検索機能（曖昧検索・会社名検索・在庫数・金額）  
  - ソート機能  

- 商品の詳細情報閲覧機能  

- 商品登録機能  
  - 画像登録も含む  

- 商品編集機能  

- 商品削除機能  

  　　
-------------------------------------------------------------
　　
## その他
- 開発環境  
  - Laravel 10 + Laravel Sail  
  - Docker
  - MySQL  
- フロント  
  - Bootstrap  
  - React（JavaScript）
  - Vite

◆環境構築の手順　　
STEP1　プロジェクトの全ファイルを取得する。 ファイルをクローン、またはダウンロードする。　

STEP2　.envファイルの設定 env.example参考　

STEP3　Dockerコンテナのビルドと起動 プロジェクトディレクトリで以下のコマンドを実行する。 ./vendor/bin/sail up -d

STEP4　マイグレーションの実行 プロジェクトディレクトリで以下のコマンドを実行する。 ./vendor/bin/sail php artisan migrate

STEP5 Reactのビルドと開発サーバーの起動 プロジェクトディレクトリで以下のコマンドを実行する。 ./vendor/bin/sail npm run dev

※Ubuntuの画面がブラウザに表示される場合は、 Apache2を止めるために、以下のコマンドを実行してください。 sudo systemctl stop apache2



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
