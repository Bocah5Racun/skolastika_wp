const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;
const wpElement = wp.element.createElement;
const ReactElement = React.createElement;

registerBlockType("skolastika/highlight", {
  title: "Highlight",
  icon: "smiley",
  category: "common",
  attributes: {
    title: { type: "string" },
    content: { type: "string" },
  },
  description: "Block for highlighting specific text.",
  edit: (props) => {
    const updateContent = (highlightText) =>
      props.setAttributes({ content: highlightText });
    const updateTitle = (event) =>
      props.setAttributes({ title: event.target.value });
    return ReactElement(
      "div",
      { className: "highlight" },
      ReactElement("input", {
        type: "text",
        style: {
          fontWeight: 700,
        },
        value: props.attributes.title,
        placeholder: "The title of the highlight.",
        onChange: updateTitle,
      }),
      ReactElement(RichText, {
        value: props.attributes.content,
        placeholder: "The body text of the highlight.",
        onChange: updateContent,
      })
    );
  },
  save: (props) => {
    return wpElement(
      "div",
      { className: "highlight" },
      props.attributes.title && wpElement("h3", null, props.attributes.title),
      ReactElement(RichText.Content, {
        value: props.attributes.content,
      })
    );
  },
});
