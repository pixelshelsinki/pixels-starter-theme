/* eslint-disable */

const postcssNormalize 	= require('postcss-normalize')
const autoprefixer 		= require('autoprefixer')
const cssnano 			= require('cssnano')

module.exports = {
	plugins: [
		autoprefixer(),
		postcssNormalize(),
		cssnano(
			{
	            preset: 'default',
	        }
        )
	]
}