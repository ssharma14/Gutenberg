"use strict";

wp.domReady(function () {
  wp.blocks.unregisterBlockVariation('core/columns', 'two-columns-one-third-two-thirds');
  wp.blocks.unregisterBlockVariation('core/columns', 'two-columns-two-thirds-one-third');
  wp.blocks.unregisterBlockVariation('core/columns', 'three-columns-wider-center');
  wp.blocks.unregisterBlockVariation('core/columns', 'two-columns-equal');
  wp.blocks.unregisterBlockVariation('core/columns', 'three-columns-equal');
  wp.blocks.unregisterBlockVariation('core/columns', 'one-column-full');
  wp.hooks.addFilter('blocks.registerBlockType', 'acf/column', function (blockOptions) {
    if (blockOptions.hasOwnProperty('attributes')) blockOptions.attributes.isfullwidth = {
      type: 'boolean',
      "default": ''
    };
    return blockOptions;
  });
});
wp.blocks.registerBlockVariation('core/columns', {
  name: 'one-column',
  title: '100',
  scope: ['block'],
  attributes: {
    className: 'column-100'
  },
  innerBlocks: [['acf/column']]
});
wp.blocks.registerBlockVariation('core/columns', {
  name: 'two-column',
  title: '50/50',
  icon: 'columns',
  scope: ['block'],
  attributes: {
    className: 'column-5050'
  },
  innerBlocks: [['acf/column'], ['acf/column']]
});
wp.blocks.registerBlockVariation('core/columns', {
  name: 'two-columns-two-third-one-third',
  title: '60/40',
  icon: 'columns',
  scope: ['block'],
  attributes: {
    className: 'column-7050'
  },
  innerBlocks: [['acf/column'], ['acf/column']]
});
wp.blocks.registerBlockVariation('core/columns', {
  name: 'three-column',
  title: '33/33/33',
  icon: 'columns',
  scope: ['block'],
  attributes: {
    className: 'column-33'
  },
  innerBlocks: [['acf/column'], ['acf/column'], ['acf/column']]
});