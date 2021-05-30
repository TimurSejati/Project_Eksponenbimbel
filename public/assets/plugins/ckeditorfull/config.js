/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
  // Define changes to default configuration here. For example:
  // config.language = 'fr';
  // config.uiColor = "#abcdef";
  config.extraPlugins = "mathjax";
  config.extraPlugins = "widget";
  config.extraPlugins = "lineutils";
  config.extraPlugins = "dialog";
  config.extraPlugins = "clipboard";
  // config.mathJaxLib =
  //   "//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML";
  config.extraPlugins = "cloudservices";
};
