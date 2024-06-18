const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;
const wpElement = wp.element.createElement;
const ReactElement = React.createElement;

registerBlockType("skolastika/highlight", {
  title: "Highlight",
  icon: "smiley",
  category: "common",
  attributes: {
    content: { type: "string" },
  },
  description: "Block for highlighting specific text.",
  edit: (props) => {
    const updateContent = (highlightText) =>
      props.setAttributes({ content: highlightText });
    return ReactElement(
      "div",
      { className: "highlight" },
      ReactElement(RichText, {
        value: props.attributes.content,
        onChange: updateContent,
      })
    );
  },
  save: (props) => {
    return wpElement(
      "p",
      { className: "highlight" },
      ReactElement(RichText.Content, {
        value: props.attributes.content,
      })
    );
  },
});
