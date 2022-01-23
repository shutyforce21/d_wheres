## 現在開発中...

## アプリケーション名

D_Wheres

ダンサー向けの練習場所を地図上にプロットするSNSアプリケーション。

## 機能要件

- マップ上に練習場所を登録
- ユーザー登録/ログイン/ログアウト
- プロフィール登録
- ユーザー間フォロー
- 練習場所/ユーザーの検索

## 設計

ドメイン駆動設計(DDD), テスト駆動開発(TDD)を導入。

UI部分はhttps://github.com/shutyforce21/d_wheres_front_web

※ mapbox使用

### 開発サイクル

① FeatureTest作成

② テスト実行（失敗）

③ DDDでAPIを実装

③ テスト実行（成功）

①〜④のサイクルをAPI毎に回し、開発を行う。

### Packagesディレクトリ

>クリーンアーキテクチャを採用している。コンテクストごとにディレクトリを分割し、その中で以下の3層にディレクトリを分割

- Domain
- UseCase
- Infrastructure

#### Domain
> ドメイン層。基本的にドメインモデルやバリューオブジェクトを配置
#### UseCase
> ユースケース層(アプリケーション層)。ユースケースクラス(ドメインモデルの生成/状態変更やリポジトリを使った永続化を行う)を配置
#### Infrastructure
> インフラ層。リポジトリの実装クラスやクエリサービスの実装クラスを置く

#### ツリー構造
```
app/Packages
├── Shared
│   └── Service
│       ├── ImagePath.php
│       ├── SearchData.php
│       └── UniqueCode.php
└── User
    ├── Domain
    │   ├── Spot
    │   │   ├── ReadModel
    │   │   │   ├── ReadSpot.php
    │   │   │   └── ValueObject
    │   │   │       ├── ReadAvailableTime.php
    │   │   │       └── ReadLocation.php
    │   │   ├── Spot.php
    │   │   ├── SpotFactory.php
    │   │   └── ValueObject
    │   │       ├── AvailableTime.php
    │   │       └── GeometricLocation.php
    │   └── User
    │       ├── ChildEntity
    │       │   └── Profile.php
    │       ├── ReadModel
    │       │   ├── ChildEntity
    │       │   │   └── ReadProfile.php
    │       │   └── ReadUser.php
    │       ├── User.php
    │       ├── UserFactory.php
    │       └── ValueObject
    │           └── Password.php
    ├── Infrastructure
    │   ├── Spot
    │   │   ├── FileRepository.php
    │   │   ├── FileRepositoryInterface.php
    │   │   ├── ReadRepository.php
    │   │   ├── ReadRepositoryInterface.php
    │   │   ├── Repository.php
    │   │   └── RepositoryInterface.php
    │   └── User
    │       ├── FileRepository.php
    │       ├── FileRepositoryInterface.php
    │       ├── ReadRepository.php
    │       ├── ReadRepositoryInterface.php
    │       ├── Repository.php
    │       └── RepositoryInterface.php
    └── UseCase
        ├── Spot
        │   ├── Get
        │   │   └── GetSpots.php
        │   ├── Register
        │   │   ├── Dto
        │   │   │   └── InputData.php
        │   │   └── RegisterSpot.php
        │   ├── Search
        │   │   └── SearchSpots.php
        │   └── Show
        │       └── ShowSpot.php
        └── User
            ├── Follow
            │   └── FollowUser.php
            ├── Login
            │   ├── Dto
            │   │   └── InputData.php
            │   └── UserLogin.php
            ├── Register
            │   ├── Dto
            │   │   └── InputData.php
            │   └── RegisterUser.php
            ├── SearchUser
            │   └── SearchUser.php
            ├── ShowProfile
            │   └── ShowProfile.php
            ├── Unfollow
            │   └── Unfollow.php
            └── UpdateProfile
                ├── Dto
                │   └── InputData.php
                └── UpdateProfile.php
```

### testsディレクトリ

- Feature
- Unit

#### Feature
> Controllerのメソッド単位でのテスト
#### Unit
> ドメインモデルの生成や、ドメインサービスのロジックをテスト

#### ツリー構造
```
tests
├── CreatesApplication.php
├── Feature
│   ├── AuthController
│   │   ├── LoginTest.php
│   │   ├── LogoutTest.php
│   │   └── RegisterUserTest.php
│   ├── ProfileController
│   │   ├── RegisterProfileTest.php
│   │   └── ShowProfileTest.php
│   ├── SpotController
│   │   ├── RegisterSpotTest.php
│   │   └── ShowSpotTest.php
│   └── UserController
│       └── FollowTest.php
├── TestCase.php
└── Unit
    └── ExampleTest.php
```
## Requirement

* composer 1.10.10
* php 8.0.14
* Laravel 8.75.0
* MySQL 8.0.27

## Installation

* 環境構築方法記載

## Author
* 作成者: shutyForce
* E-mail: bbshuty.devlife@gmail.com
