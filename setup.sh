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
replace_file wp-content/themes/##replace##/src/Theme.php;
replace_file wp-content/themes/##replace##/style.css;

mv wp-content/themes/##replace## wp-content/themes/$project;

rm -rf .git
git init
