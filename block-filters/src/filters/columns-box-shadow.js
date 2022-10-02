/* eslint-disable react/jsx-props-no-spreading, react/prop-types */
import classnames from 'classnames';

const { assign, merge } = lodash;

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl  } = wp.components;

/**
 * Add Box Shadow attribute to Columns block
 *
 * @param  {Object} settings Original block settings
 * @param  {string} name     Block name
 * @return {Object}          Filtered block settings
 */
function addAttributes(settings, name) {
	if (name === 'core/columns') {
		return assign({}, settings, {
			attributes: merge(settings.attributes, {
				boxshadow: {
					type: 'boolean',
				}
			}),
		});
	}
	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'blockfilters/columns-block/add-attributes',
	addAttributes,
);

/**
 * Add Box Shadow control to Columns block
 */
const addInspectorControl = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		
		const {
			attributes: { boxshadow },
			setAttributes,
			name,
		} = props;

		if (name !== 'core/columns') {
			return <BlockEdit {...props} />;
		}

		return (
			<Fragment>
				<BlockEdit {...props} />
				<InspectorControls>
					<PanelBody title="Settings" initialOpen={true}>
						<ToggleControl
							label="Enable box shadow for columns?"
							help={boxshadow ? "Yes" : "No"}
							checked={boxshadow}
							onChange={() => setAttributes({ boxshadow: !boxshadow })}
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'withInspectorControl');

addFilter(
	'editor.BlockEdit',
	'blockfilters/columns-block/add-inspector-controls',
	addInspectorControl,
);

/**
 * Add box shadow class to the block in the editor
 */
const addBoxshadowClassEditor = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const {
			attributes: { boxshadow },
			className,
			name,
		} = props;

		if (name !== 'core/columns') {
			return <BlockListBlock {...props} />;
		}

		return (
			<BlockListBlock
				{...props}
				className={classnames(className, boxshadow ? ` has-box-shadow` : '')}
			/>
		);
	};
}, 'withClientIdClassName');

addFilter(
	'editor.BlockListBlock',
	'blockfilters/columns-block/add-editor-class',
	addBoxshadowClassEditor,
);

/**
 * Add box shadow class to the block on the front end
 *
 * @param  {Object} props      Additional props applied to save element.
 * @param  {Object} block      Block type.
 * @param  {Object} attributes Current block attributes.
 * @return {Object}            Filtered props applied to save element.
 */
 function addBoxshadowClassFrontEnd(props, block, attributes) {
	if (block.name !== 'core/columns') {
		return props;
	}

	const { className } = props;
	const { boxshadow } = attributes;

	return assign({}, props, {
		className: classnames(className, boxshadow ? ` has-box-shadow` : ''),
	});
}

// Comment out to test the PHP approach defined in intro-to-block-filters.php
addFilter(
	'blocks.getSaveContent.extraProps',
	'blockfilters/columns-block/add-front-end-class',
	addBoxshadowClassFrontEnd,
);