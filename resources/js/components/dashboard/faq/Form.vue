<template>

    <ValidationObserver ref="form" v-slot="{ handleSubmit }">

        <div v-if="submitedFaq" class="card small text-success border-0 mb-3 p-2 rounded-lg">
            <div class="card-body border-success border border-5 border-end-0 border-top-0 border-bottom-0 p-2 d-flex justify-content-between">
                <div>
                    <i class="fa fa-check-circle"></i>
                    Faq {{ submitedFaq.title }} Criado!
                    <p class="m-0 text-muted">Você pode visualizar o faq <a @click="closeAlert" :href="route('web.faq.show', [faqIndex, submitedFaq.slug])" target="_blank">aqui</a></p>
                </div>
                <span @click="closeAlert">
                    <i class="fa fa-times text-muted"></i>
                </span>
            </div>
        </div>
        
        <form @submit.prevent="handleSubmit(saveFaq)">
            <div class="row">
                <div class="col-xl-12">
                    
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <ValidationProvider vid="title" name="título" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
                                <label for="faq-title">Título</label>
                                <input v-model="faq.title" type="text" class="form-control" :class="{'is-invalid': errors.length > 0}">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <ValidationProvider vid="description" name="descrição" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
                                 <label for="faq-description">Descrição</label>
                                <textarea v-model="faq.description" class="form-control no-resize" :class="{'is-invalid': errors.length > 0}"></textarea>
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <div class="mb-4"></div>

                            <ValidationProvider vid="body" name="conteúdo" rules="required" class="form-group" v-slot="{ errors }" mode="eager">
                                <div :class="{'has-error': errors.length > 0}">
                                    <label for="faq-body">Conteúdo</label>
                                    <textarea ref="faqBody" v-model="faq.body" class="form-control summernote"></textarea>
                                    <span class="text-danger">{{ errors[0] }}</span>
                                </div>
                            </ValidationProvider>

                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ edit ? 'Atualizar' : 'Salvar' }}
                                </button>
                            </div>

                        </div>
                    </div>
                    

                </div>
            </div>
        </form>

    </ValidationObserver>

</template>

<script>
    
    import { ValidationObserver, ValidationProvider, extend } from 'vee-validate'
    import { required } from 'vee-validate/dist/rules'
    import * as $ from 'jquery'
    import 'summernote/dist/summernote-lite.js'

    extend('required', required)

    export default {
        components: { ValidationObserver, ValidationProvider },
        props: {
            edit: Object
        },
        data() {
            return {
                faq: {
                    id: '',
                    title: '',
                    description: '',
                    body: ''
                },
                submitedFaq: null,
                faqIndex: ''
            }
        },
        methods: {
            
            closeAlert() {
                this.submitedFaq = null
            },

            saveFaq() {

                var self = this
                
                axios({
                    method: self.edit ? 'put' : 'post',
                    url: self.edit ? self.route('dashboard.faq.update', self.faq) : self.route('dashboard.faq.store'),
                    data: self.faq
                })
                .then(function(response){
                    
                    if(!self.edit) {
                        self.$refs.form.reset()

                        self.faq.title = self.faq.description = self.faq.body = ''
                    
                        $('.summernote').summernote('code', '');
                    }
                
                    

                    if(self.edit) {
                        // location.href = self.route('dashboard.faq.index')
                        location.reload()
                    } else {
                        self.submitedFaq = response.data
                        self.faqIndex = self.submitedFaq.title.charAt(0).toLowerCase()
                    }

                    

                })
                .catch(function(error){
                    console.log(error.response.data.errors)
                    self.$refs.form.setErrors(error.response.data.errors)
                })
            },
        },
        mounted() {
            
            var self = this

            $.extend($.summernote.lang, {
                'pt-BR': {
                font: {
                    bold: 'Negrito',
                    italic: 'Itálico',
                    underline: 'Sublinhado',
                    clear: 'Remover estilo da fonte',
                    height: 'Altura da linha',
                    name: 'Fonte',
                    strikethrough: 'Riscado',
                    subscript: 'Subscrito',
                    superscript: 'Sobrescrito',
                    size: 'Tamanho da fonte'
                },
                image: {
                    image: 'Imagem',
                    insert: 'Inserir imagem',
                    resizeFull: 'Redimensionar Completamente',
                    resizeHalf: 'Redimensionar pela Metade',
                    resizeQuarter: 'Redimensionar a um Quarto',
                    floatLeft: 'Flutuar para Esquerda',
                    floatRight: 'Flutuar para Direita',
                    floatNone: 'Não Flutuar',
                    shapeRounded: 'Forma: Arredondado',
                    shapeCircle: 'Forma: Círculo',
                    shapeThumbnail: 'Forma: Miniatura',
                    shapeNone: 'Forma: Nenhum',
                    dragImageHere: 'Arraste Imagem ou Texto para cá',
                    dropImage: 'Solte Imagem ou Texto',
                    selectFromFiles: 'Selecione a partir dos arquivos',
                    maximumFileSize: 'Tamanho máximo do arquivo',
                    maximumFileSizeError: 'Tamanho máximo do arquivo excedido.',
                    url: 'URL da imagem',
                    remove: 'Remover Imagem',
                    original: 'Original'
                },
                video: {
                    video: 'Vídeo',
                    videoLink: 'Link para vídeo',
                    insert: 'Inserir vídeo',
                    url: 'URL do vídeo?',
                    providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion ou Youku)'
                },
                link: {
                    link: 'Link',
                    insert: 'Inserir link',
                    unlink: 'Remover link',
                    edit: 'Editar',
                    textToDisplay: 'Texto para exibir',
                    url: 'Para qual URL este link leva?',
                    openInNewWindow: 'Abrir em uma nova janela'
                },
                table: {
                    table: 'Tabela',
                    addRowAbove: 'Adicionar linha acima',
                    addRowBelow: 'Adicionar linha abaixo',
                    addColLeft: 'Adicionar coluna à esquerda',
                    addColRight: 'Adicionar coluna à direita',
                    delRow: 'Excluir linha',
                    delCol: 'Excluir coluna',
                    delTable: 'Excluir tabela'
                },
                hr: {
                    insert: 'Linha horizontal'
                },
                style: {
                    style: 'Estilo',
                    p: 'Normal',
                    blockquote: 'Citação',
                    pre: 'Código',
                    h1: 'Título 1',
                    h2: 'Título 2',
                    h3: 'Título 3',
                    h4: 'Título 4',
                    h5: 'Título 5',
                    h6: 'Título 6'
                },
                lists: {
                    unordered: 'Lista com marcadores',
                    ordered: 'Lista numerada'
                },
                options: {
                    help: 'Ajuda',
                    fullscreen: 'Tela cheia',
                    codeview: 'Ver código-fonte'
                },
                paragraph: {
                    paragraph: 'Parágrafo',
                    outdent: 'Menor tabulação',
                    indent: 'Maior tabulação',
                    left: 'Alinhar à esquerda',
                    center: 'Alinhar ao centro',
                    right: 'Alinha à direita',
                    justify: 'Justificado'
                },
                color: {
                    recent: 'Cor recente',
                    more: 'Mais cores',
                    background: 'Fundo',
                    foreground: 'Fonte',
                    transparent: 'Transparente',
                    setTransparent: 'Fundo transparente',
                    reset: 'Restaurar',
                    resetToDefault: 'Restaurar padrão',
                    cpSelect: 'Selecionar'
                },
                shortcut: {
                    shortcuts: 'Atalhos do teclado',
                    close: 'Fechar',
                    textFormatting: 'Formatação de texto',
                    action: 'Ação',
                    paragraphFormatting: 'Formatação de parágrafo',
                    documentStyle: 'Estilo de documento',
                    extraKeys: 'Extra keys'
                },
                help: {
                    'insertParagraph': 'Inserir Parágrafo',
                    'undo': 'Desfazer o último comando',
                    'redo': 'Refazer o último comando',
                    'tab': 'Tab',
                    'untab': 'Desfazer tab',
                    'bold': 'Colocar em negrito',
                    'italic': 'Colocar em itálico',
                    'underline': 'Sublinhado',
                    'strikethrough': 'Tachado',
                    'removeFormat': 'Remover estilo',
                    'justifyLeft': 'Alinhar à esquerda',
                    'justifyCenter': 'Centralizar',
                    'justifyRight': 'Alinhar à esquerda',
                    'justifyFull': 'Justificar',
                    'insertUnorderedList': 'Lista não ordenada',
                    'insertOrderedList': 'Lista ordenada',
                    'outdent': 'Recuar parágrafo atual',
                    'indent': 'Avançar parágrafo atual',
                    'formatPara': 'Alterar formato do bloco para parágrafo(tag P)',
                    'formatH1': 'Alterar formato do bloco para H1',
                    'formatH2': 'Alterar formato do bloco para H2',
                    'formatH3': 'Alterar formato do bloco para H3',
                    'formatH4': 'Alterar formato do bloco para H4',
                    'formatH5': 'Alterar formato do bloco para H5',
                    'formatH6': 'Alterar formato do bloco para H6',
                    'insertHorizontalRule': 'Inserir Régua horizontal',
                    'linkDialog.show': 'Inserir um Hiperlink'
                },
                history: {
                    undo: 'Desfazer',
                    redo: 'Refazer'
                },
                specialChar: {
                    specialChar: 'CARACTERES ESPECIAIS',
                    select: 'Selecionar Caracteres Especiais'
                }
                }
            });
           
            $('.summernote').summernote({
                lang: 'pt-BR',
                height: 'auto',
                minHeight: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                callbacks: {
                    onChange: function(contents) {

                        self.faq.body = contents
                    }
                }
            })

            $('button[aria-label="Imagem"]').click(function(){
                $('.note-modal-backdrop').hide()
                $('.note-modal').removeClass('open')
                $('.note-image-input').click()
            })

            if(self.edit) {
                self.faq = self.edit

                $('.summernote').summernote('code', self.faq.body)
            }

        }
    }
</script>

<style scoped>

    label { font-weight: bold; margin-bottom: 0.4rem; }

    .cover-placeholder { cursor: pointer; }

    .form-group { margin-bottom: 1.5rem !important; }

    .note-modal-footer { padding: 1.5rem; }
    
    .invalid-feedback, .text-danger { font-size: 0.8rem; font-weight: bold; }

    textarea.no-resize { resize: none; }

</style>

<style>
    .has-error .note-editor { border: 1px solid #dc3545; }
    .has-error .note-toolbar { background: #dc3545; }
    .has-error .note-statusbar { background: #dc3545 !important; }
</style>