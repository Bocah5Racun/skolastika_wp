wp.blocks.registerBlockType("skolastika/highlight-block", {
  title: "Highlight Block",
  icon: "warning",
  category: "common",
  attributes: {
    title: { type: "string" },
    content: { type: "string" },
  },
  edit: function (props) {
    function updateContent(event) {
      props.setAttributes({ content: event.target.value });
    }
    return React.createElement(
      "div",
      { className: "highlight" },
      React.createElement("input", {
        style: {
          outline: "none",
        },
        type: "text",
        value: props.attributes.content,
        onChange: updateContent,
      })
    );
  },
  save: function (props) {
    return wp.element.createElement(
      "p",
      { className: "highlight" },
      props.attributes.content
    );
  },
});
