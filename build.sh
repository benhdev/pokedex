sh phptest.sh
rm -rf public
cp -r src src_temp

mkdir public
mkdir src_temp/php_include_last
mv src_temp/php/index.php src_temp/php_include_last/index.php
cat src_temp/php/includes.php >> public/index.php
rm src_temp/php/includes.php
cat src_temp/html/header.phtml >> public/index.php
cp -r src_temp/html/model public/includes
cp src_temp/html/pagination/*.phtml public/includes
rm -rf src_temp/php
cat src_temp/php_include_last/*.php >> public/index.php

cat src_temp/html/footer.phtml >> public/index.php
rm -rf src_temp/html

cat src_temp/css/*.css > public/main.css
rm -rf src_temp/css

for file in src_temp/js/*.js; do (cat "${file}"; echo) >> public/main.js; done
rm -rf src_temp/js

rm -rf src_temp

echo 'Build complete.'