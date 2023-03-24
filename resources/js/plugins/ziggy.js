const Ziggy = {"url":"http:\/\/44.209.181.62","port":null,"defaults":{},"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"web.home.property.index":{"uri":"imoveis\/home","methods":["GET","HEAD"]},"web.catalog.property.index":{"uri":"imoveis\/catalogo","methods":["GET","HEAD"]},"web.catalog.city.index":{"uri":"cidades","methods":["GET","HEAD"]},"web.bookmark.property.index":{"uri":"imoveis\/favoritos","methods":["GET","HEAD"]},"web.history.visitor":{"uri":"historico\/{visitor}","methods":["GET","HEAD"]},"web.home.post.index":{"uri":"posts","methods":["GET","HEAD"]},"web.blog.post.index":{"uri":"posts\/blog","methods":["GET","HEAD"]},"web.contact.store":{"uri":"contato","methods":["POST"]},"web.bookmark.store":{"uri":"favoritos","methods":["POST"]},"web.bookmark.destroy":{"uri":"favoritos\/{id}\/deletar","methods":["DELETE"]},"web.comment.store":{"uri":"comentario","methods":["POST"]},"web.catalog.monthly_properties.index":{"uri":"imoveis\/mensais","methods":["GET","HEAD"]},"web.search.post.index":{"uri":"busca\/posts","methods":["GET","HEAD"]},"web.search.faq.index":{"uri":"busca\/faqs","methods":["GET","HEAD"]},"web.search.property.index":{"uri":"busca\/imoveis","methods":["GET","HEAD"]},"web.home.index":{"uri":"\/","methods":["GET","HEAD"]},"web.catalog.index":{"uri":"catalogo","methods":["GET","HEAD"]},"web.product.show":{"uri":"produto\/{id}","methods":["GET","HEAD"]},"web.about.index":{"uri":"sobre","methods":["GET","HEAD"]},"web.contact.create":{"uri":"contato","methods":["GET","HEAD"]},"web.faq.index":{"uri":"faq","methods":["GET","HEAD"]},"web.faq.show":{"uri":"faq\/{index}\/{faq?}","methods":["GET","HEAD"],"bindings":{"faq":"slug"}},"web.blog.index":{"uri":"blog","methods":["GET","HEAD"]},"web.blog.post.show":{"uri":"post\/{post}","methods":["GET","HEAD"],"bindings":{"post":"slug"}},"web.bookmark.index":{"uri":"favoritos","methods":["GET","HEAD"]},"web.privacy.index":{"uri":"privacidade","methods":["GET","HEAD"]},"web.search.index":{"uri":"busca","methods":["GET","HEAD"]},"web.monthly_properties.index":{"uri":"imoveis-mes","methods":["GET","HEAD"]},"dashboard.auth.login.create":{"uri":"admin","methods":["GET","HEAD"]},"dashboard.auth.login.store":{"uri":"login","methods":["POST"]},"dashboard.auth.forgot-password":{"uri":"recuperar-senha","methods":["GET","HEAD"]},"dashboard.blog.post.category.index":{"uri":"painel\/post\/categorias","methods":["GET","HEAD"]},"dashboard.blog.post.category.store":{"uri":"painel\/post\/categoria","methods":["POST"]},"dashboard.blog.post.publish.update":{"uri":"painel\/post\/{post}\/publicar","methods":["PATCH"],"bindings":{"post":"id"}},"dashboard.blog.post.highlight.update":{"uri":"painel\/post\/{post}\/destacar","methods":["PATCH"],"bindings":{"post":"id"}},"dashboard.blog.post.update":{"uri":"painel\/post\/{post}\/atualizar","methods":["PUT"],"bindings":{"post":"id"}},"dashboard.blog.post.store":{"uri":"painel\/post","methods":["POST"]},"dashboard.blog.post.destroy":{"uri":"painel\/post\/{post}\/deletar","methods":["DELETE"],"bindings":{"post":"id"}},"dashboard.blog.post.at_home":{"uri":"painel\/post\/{post}\/home","methods":["PUT"],"bindings":{"post":"id"}},"dashboard.blog.post.user.index":{"uri":"painel\/post\/autores","methods":["GET","HEAD"]},"dashboard.blog.category.store":{"uri":"painel\/categoria","methods":["POST"]},"dashboard.blog.category.update":{"uri":"painel\/categoria\/{category}\/atualizar","methods":["PUT"],"bindings":{"category":"id"}},"dashboard.blog.category.destroy":{"uri":"painel\/categoria\/{category}\/deletar","methods":["DELETE"],"bindings":{"category":"id"}},"dashboard.blog.post.comment.moderate.update":{"uri":"painel\/comentario\/{comment}\/moderar\/{status}","methods":["PATCH"],"bindings":{"comment":"id"}},"dashboard.blog.post.comment.destroy":{"uri":"painel\/comentario\/{comment}\/deletar","methods":["DELETE"],"bindings":{"comment":"id"}},"dashboard.faq.store":{"uri":"painel\/faq","methods":["POST"]},"dashboard.faq.update":{"uri":"painel\/faq\/{faq}\/atualizar","methods":["PUT"],"bindings":{"faq":"id"}},"dashboard.faq.destroy":{"uri":"painel\/faq\/{faq}\/deletar","methods":["DELETE"],"bindings":{"faq":"id"}},"dashboard.user.store":{"uri":"painel\/usuario","methods":["POST"]},"dashboard.user.update":{"uri":"painel\/usuario\/{user}\/atualizar","methods":["PUT"],"bindings":{"user":"id"}},"dashboard.user.destroy":{"uri":"painel\/usuario\/{user}\/deletar","methods":["DELETE"],"bindings":{"user":"id"}},"dashboard.contact.destroy":{"uri":"painel\/contato\/{contact}","methods":["DELETE"],"bindings":{"contact":"id"}},"dashboard.configuration.update":{"uri":"painel\/configuracao","methods":["POST"]},"dashboard.index":{"uri":"painel","methods":["GET","HEAD"]},"dashboard.property.index":{"uri":"painel\/imoveis","methods":["GET","HEAD"]},"dashboard.property.show":{"uri":"painel\/imovel\/{property}","methods":["GET","HEAD"],"bindings":{"property":"id"}},"dashboard.contact.index":{"uri":"painel\/contatos","methods":["GET","HEAD"]},"dashboard.contact.show":{"uri":"painel\/contato\/{contact}","methods":["GET","HEAD"],"bindings":{"contact":"id"}},"dashboard.contact.update":{"uri":"painel\/contato\/{contact}\/atualizar","methods":["PUT"],"bindings":{"contact":"id"}},"dashboard.blog.post.index":{"uri":"painel\/posts","methods":["GET","HEAD"]},"dashboard.blog.post.create":{"uri":"painel\/post\/criar","methods":["GET","HEAD"]},"dashboard.blog.post.edit":{"uri":"painel\/post\/{post}\/editar","methods":["GET","HEAD"],"bindings":{"post":"id"}},"dashboard.blog.comment.index":{"uri":"painel\/comentarios","methods":["GET","HEAD"]},"dashboard.blog.category.index":{"uri":"painel\/categorias","methods":["GET","HEAD"]},"dashboard.blog.category.create":{"uri":"painel\/categoria\/criar","methods":["GET","HEAD"]},"dashboard.blog.category.edit":{"uri":"painel\/categoria\/{category}\/editar","methods":["GET","HEAD"],"bindings":{"category":"id"}},"dashboard.faq.index":{"uri":"painel\/faqs","methods":["GET","HEAD"]},"dashboard.faq.create":{"uri":"painel\/faq\/criar","methods":["GET","HEAD"]},"dashboard.faq.edit":{"uri":"painel\/faq\/{faq}\/editar","methods":["GET","HEAD"],"bindings":{"faq":"id"}},"dashboard.user.index":{"uri":"painel\/usuarios","methods":["GET","HEAD"]},"dashboard.user.create":{"uri":"painel\/usuario\/criar","methods":["GET","HEAD"]},"dashboard.user.edit":{"uri":"painel\/usuario\/{user}\/editar","methods":["GET","HEAD"],"bindings":{"user":"id"}},"dashboard.configuration.create":{"uri":"painel\/configuracao","methods":["GET","HEAD"]},"dashboard.privacy.create":{"uri":"painel\/privacidade","methods":["GET","HEAD"]},"dashboard.privacy.store":{"uri":"painel\/privacidade","methods":["POST"]},"dashboard.logout":{"uri":"painel\/logout","methods":["POST"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };