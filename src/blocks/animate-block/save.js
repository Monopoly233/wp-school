import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save({ attributes }) {
    const { animationType } = attributes;
    const blockProps = useBlockProps.save({
        'data-aos': animationType
    });

    return (
        <div {...blockProps}>
            <InnerBlocks.Content />
        </div>
    );
} 