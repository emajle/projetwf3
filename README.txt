 composer update
composer require symfony/webpack-encore-bundle
yarn install
yarn add @symfony/webpack-encore --dev

adresse mail site : no-reply@projetwf3.test

registration controller -> voir route de redirection (app_home?)
Une fois que l'authentif est faite voir route de redirection (app_home?)

/reset-password
app_forgot_password_request -> à changer

changer les Not NULL dans la table user quand on va etre en prod


generation d'image : fonction = asset('')

<img class="card-img-top" src="{{asset('build/images/1.jpg')}}" alt="img">
 style="background-image:url(./fxlogo.png);">