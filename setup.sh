#!/bin/bash

replace_file() {
    sed -i "s/##replace##/$project/g" $1;
}

if [ -z $1 ]; then
    echo 'no projectname given!!';
fi

project=$1;


replace_file composer.json;
replace_file package.json;
replace_file package-lock.json;
replace_file webpack.config.js;
replace_file .gitignore;
replace_file wp-content/themes/##replace##/src/Theme.php;
replace_file wp-content/themes/##replace##/style.css;

mv wp-content/themes/##replace## wp-content/themes/$project;

composer install
npm install

rm -rf .git
rm setup.sh
git init
git add --all
git commit -am "[INIT] Initial commit"

echo "Setup for $project finished! Now run "docker compose up" to biuld a wordpress site!"
