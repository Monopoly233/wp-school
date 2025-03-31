import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { animationType } = attributes;
    const blockProps = useBlockProps({
        'data-aos': animationType
    });

    const animationOptions = [
        { label: __('Fade Up', 'school'), value: 'fade-up' },
        { label: __('Fade Down', 'school'), value: 'fade-down' },
        { label: __('Fade Left', 'school'), value: 'fade-left' },
        { label: __('Fade Right', 'school'), value: 'fade-right' },
        { label: __('Zoom In', 'school'), value: 'zoom-in' },
        { label: __('Zoom Out', 'school'), value: 'zoom-out' }
    ];

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Animation Settings', 'school')}>
                    <SelectControl
                        label={__('Animation Type', 'school')}
                        value={animationType}
                        options={animationOptions}
                        onChange={(value) => setAttributes({ animationType: value })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <InnerBlocks />
            </div>
        </>
    );
} 