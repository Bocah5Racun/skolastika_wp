wp.blocks.registerBlockStyle("core/paragraph", {
  name: "highlight",
  label: "Highlight",
});

// wp.blocks.registerBlockType("skolastika/highlight-block", {
//   title: "Highlight Block",
//   icon: "warning",
//   category: "common",
//   attributes: {
//     title: { type: "string" },
//     content: { type: "string" },
//   },
//   edit: function (props) {
//     function updateContent(event) {
//       props.setAttributes({ content: event.target.value });
//     }
//     return (
//       <div { ...useBlockProps() }>
//             <BlockControls>
//                 <ToolbarGroup>
//                     <AlignmentToolbar
//                         value={ attr.alignment }
//                         onChange={ onChangeAlignment }
//                     />
//                 </ToolbarGroup>
//             </BlockControls>

//             <RichText
//                 className={ className }
//                 style={ { textAlign: attr.alignment } }
//                 tagName="p"
//                 onChange={ onChangeContent }
//                 value={ attr.content }
//             />
//         </div>
//     );
//   },
//   save: function (props) {
//     return wp.element.createElement(
//       "p",
//       { className: "highlight" },
//       props.attributes.content
//     );
//   },
// });
