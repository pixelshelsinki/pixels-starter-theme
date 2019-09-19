/* eslint-disable */

const postcssNormalize 	= require('postcss-normalize')
const postcssClean 		= require('postcss-clean')
const autoprefixer 		= require('autoprefixer')
const cssnano 			= require('cssnano')

module.exports = {
	plugins: [
		autoprefixer(),
		postcssNormalize(),
		postcssClean(),
		cssnano(
			{
	            preset: 'default',
	        }
        )
	]
}