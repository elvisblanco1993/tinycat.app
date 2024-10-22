import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import { Markdown } from 'tiptap-markdown';
import Link from '@tiptap/extension-link'

window.setupEditor = function (content) {
  let editor

  return {
    content: content,

    init(element) {
      editor = new Editor({
        element: element,
        editorProps: {
            attributes: {
                class: 'p-2 prose prose-sm dark:prose-invert min-h-36 prose-h2:mb-0 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 focus:outline-none',
            },
        },
        extensions: [
            StarterKit.configure({
                heading: {
                    levels: [2, 3, 4],
                },
            }),
            Markdown,
            Link.configure({
                autolink: true,
                defaultProtocol: 'https',
            }),
        ],
        content: this.content,
        onUpdate: ({ editor }) => {
          this.content = editor.getHTML()
        },
    })
    this.editor = editor;
    this.toggleBold = () => editor.chain().focus().toggleBold().run();
    this.toggleItalic = () => editor.chain().focus().toggleItalic().run();
    this.toggleH2 = () =>  editor.chain().focus().toggleHeading({ level: 2 }).run();
    this.toggleH3 = () =>  editor.chain().focus().toggleHeading({ level: 3 }).run();
    this.toggleH4 = () =>  editor.chain().focus().toggleHeading({ level: 4 }).run();
    this.toggleOrderedList = () =>  editor.chain().focus().toggleOrderedList().run();
    this.toggleBulletList = () =>  editor.chain().focus().toggleBulletList().run();

      this.$watch('content', (content) => {
        // If the new content matches TipTap's then we just skip.
        if (content === editor.getHTML()) return
        editor.commands.setContent(content, false)
      })
    },
  }
}
