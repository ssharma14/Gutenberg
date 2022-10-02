//Add Background image option to Columns
(function() {
    const { __ } = wp.i18n;
    const { addFilter } = wp.hooks;
    const { createHigherOrderComponent } = wp.compose;
    const el = wp.element.createElement;
    const { Fragment } = wp.element;
    const { InspectorControls, MediaUpload, MediaUploadCheck } = wp.blockEditor;
    const { PanelBody, Button, ResponsiveWrapper } = wp.components;
    addFilter('blocks.registerBlockType', 'extend-columns/attributes', addAttribute);
    addFilter('editor.BlockEdit', 'extend-columns/edit', createHigherOrderComponent(addControl));
    addFilter('blocks.getSaveElement', 'extend-columns/save', customSave);
    
    function addAttribute(settings, name) {
        // Abort if not columns
        if (!['core/columns'].includes(name)) {
          return settings;
        }
    
        // add new attribute
        settings.attributes = Object.assign(settings.attributes, {
          backgroundImageID: { type: 'number' },
          backgroundImageURL: { type: 'string' },
        });
    
        return settings;
    }
    
    function addControl(BlockEdit) {
        return (props) => {
          if (!['core/columns'].includes(props.name)) {
            return el(BlockEdit, props);
        }
    
        const atts = props.attributes;

        return el(Fragment, {},
        el(BlockEdit, props),
        el(InspectorControls, {},
            el(PanelBody, {
            title: 'Background Image',
            initialOpen: true,
            },
            el('div', {},
                ( atts.backgroundImageURL &&
                el('img', {
                    src: atts.backgroundImageURL
                })
                ),
                    el(MediaUpload, {
                    allowedTypes: 'image',
                    value: atts.backgroundImageID,
                    onSelect: setbackgroundImage,
                    render: renderbackgroundImage,
                })
            )
            )
        )
        );
    
          function setbackgroundImage(media) {
            props.setAttributes({
              backgroundImageURL: media.url,
              backgroundImageID: media.id,
            });
          }
    
          function renderbackgroundImage(obj) {
            if(atts.backgroundImageURL) {
              atts.className = atts.className.replace( /has-background-image/, '' );
              atts.className += ' has-background-image';
            }
    
            const buttonLabel = atts.mediaID ? 'Change image' : 'Upload image';
      
            return el(Button, {
              className: atts.backgroundImageID ? 'button button--transparent' : 'button',
              onClick: obj.open,
            },
              buttonLabel
            );
          }
        }
    }
    
    function customSave(element, blockType, atts) {
    // Abort if not columns block
        if(blockType.name !== 'core/columns') { return element; }

        // Put the mobile image as CSS var
        if(atts.backgroundImageURL) {
            element.props.style['--backgroundImage'] = `url("${atts.backgroundImageURL}")`;
        }
        return element;
    }

}());