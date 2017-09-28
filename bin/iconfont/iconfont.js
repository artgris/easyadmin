var webfontsGenerator = require('webfonts-generator');
var fs = require('fs');

var dir = 'front/assets/icons/svg';
var getFilename = (dir) => {
	return fs.readdirSync(dir);
};
var files = getFilename(dir);
var svg = [];

for (var i = 0; i < files.length; i++) {
	svg.push(dir + '/' + files[i]);
}

webfontsGenerator({
	fontName: 'icon',
  files: svg,
  types: ['eot', 'woff', 'ttf', 'svg'],
  dest: './web/fonts',
  cssFontsUrl: '/fonts',
  cssTemplate: 'bin/iconfont/templates/scss.hbs',
  cssDest: 'front/scss/typography/_iconfont.scss',
  html: false,
  tamplateOption: {
    classPrefix: 'icon-',
    baseSelector: '.icon'
  }
}, function(error) {
  if (error) console.log('Fail!', error)
  else console.log('Done!')
});