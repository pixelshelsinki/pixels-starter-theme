/* eslint-disable */

const postcssNormalize = require('postcss-normalize')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const gradientTransparencyFix = require('postcss-gradient-transparency-fix')

module.exports = {
	plugins: [
		autoprefixer(),
		postcssNormalize(),
		cssnano(
			{
				preset: 'default',
			}
		),
		gradientTransparencyFix()
	]
}