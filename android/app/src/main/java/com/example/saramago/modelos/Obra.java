package com.example.saramago.modelos;

import java.lang.reflect.Array;
import java.util.Date;

public class Obra {
    private int id, ano, preco, Cdu_id, Colecao_id;
    private String imgCapa, tipoObra, titulo, resumo, editor, descricao, local, edicao, assuntos, dataRegisto, dataAtualizado;

    private static int autoIncrement = 1;

    public Obra(int id, String imgCapa, int ano, int preco, int Cdu_id, int Colecao_id, String titulo, String resumo, String editor,
                String tipoObra, String descricao, String local, String edicao,
                String assuntos, String dataRegisto, String dataAtualizado) {
        this.id = autoIncrement++;
        this.imgCapa = imgCapa;
        this.ano = ano;
        this.preco = preco;
        this.titulo = titulo;
        this.resumo = resumo;
        this.editor = editor;
        this.tipoObra = tipoObra;
        this.descricao = descricao;
        this.local = local;
        this.edicao = edicao;
        this.assuntos = assuntos;
        this.dataRegisto = dataRegisto;
        this.dataAtualizado = dataAtualizado;
        this.Cdu_id = Cdu_id;
        this.Colecao_id = Colecao_id;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getImgCapa() { return imgCapa; }

    public void setImgCapa(String imgCapa) { this.imgCapa = imgCapa; }

    public int getAno() { return ano; }

    public void setAno(int ano) { this.ano = ano; }

    public int getPreco() { return preco; }

    public void setPreco(int preco) { this.preco = preco; }

    public String getTitulo() { return titulo; }

    public void setTitulo(String titulo) { this.titulo = titulo; }

    public String getResumo() { return resumo; }

    public void setResumo(String resumo) { this.resumo = resumo; }

    public String getEditor() { return editor; }

    public void setEditor(String editor) { this.editor = editor; }

    public String getTipoObra() { return tipoObra; }

    public void setTipoObra(String tipoObra) { this.tipoObra = tipoObra; }

    public String getDescricao() { return descricao; }

    public void setDescricao(String descricao) { this.descricao = descricao; }

    public String getLocal() { return local; }

    public void setLocal(String local) { this.local = local; }

    public String getEdicao() { return edicao; }

    public void setEdicao(String edicao) { this.edicao = edicao; }

    public String getAssuntos() { return assuntos; }

    public void setAssuntos(String assuntos) { this.assuntos = assuntos; }

    public String getDataRegisto() { return dataRegisto; }

    public void setDataRegisto(String dataRegisto) { this.dataRegisto = dataRegisto; }

    public String getDataAtualizado() { return dataAtualizado; }

    public void setDataAtualizado(String dataAtualizado) { this.dataAtualizado = dataAtualizado; }

    public int getCdu_id() { return Cdu_id; }

    public void setCdu_id(int cdu_id) { Cdu_id = cdu_id; }

    public int getColecao_id() {return Colecao_id; }

    public void setColecao_id(int colecao_id) { Colecao_id = colecao_id; }

    /**
     * Nested Class
     */

    public class exemplar {
        private int id, Biblioteca_id, EstatutoExemplar_id, TipoExemplar_id, Obra_id;
        private boolean suplemento;
        private String cota, estado, codBarras, notaInterna;

        private int autoIncrement = 1;

        public exemplar(int id, int biblioteca_id, int estatutoExemplar_id, int tipoExemplar_id,
                        int obra_id, boolean suplemento, String estado, String cota,
                        String codBarras, String notaInterna) {
            this.id = autoIncrement++;
            this.Biblioteca_id = biblioteca_id;
            this.EstatutoExemplar_id = estatutoExemplar_id;
            this.TipoExemplar_id = tipoExemplar_id;
            this.Obra_id = obra_id;
            this.suplemento = suplemento;
            this.estado = estado;
            this.cota = cota;
            this.codBarras = codBarras;
            this.notaInterna = notaInterna;
        }

        public int getId() { return id; }

        public void setId(int id) { this.id = id; }

        public int getBiblioteca_id() { return Biblioteca_id; }

        public void setBiblioteca_id(int biblioteca_id) { Biblioteca_id = biblioteca_id; }

        public int getEstatutoExemplar_id() { return EstatutoExemplar_id; }

        public void setEstatutoExemplar_id(int estatutoExemplar_id) { EstatutoExemplar_id = estatutoExemplar_id; }

        public int getTipoExemplar_id() { return TipoExemplar_id; }

        public void setTipoExemplar_id(int tipoExemplar_id) { TipoExemplar_id = tipoExemplar_id; }

        public int getObra_id() { return Obra_id; }

        public void setObra_id(int obra_id) { Obra_id = obra_id; }

        public boolean isSuplemento() { return suplemento; }

        public void setSuplemento(boolean suplemento) { this.suplemento = suplemento; }

        public String getEstado() { return estado; }

        public void setEstado(String estado) { this.estado = estado; }

        public String getCota() { return cota; }

        public void setCota(String cota) { this.cota = cota; }

        public String getCodBarras() { return codBarras; }

        public void setCodBarras(String codBarras) { this.codBarras = codBarras; }

        public String getNotaInterna() { return notaInterna; }

        public void setNotaInterna(String notaInterna) { this.notaInterna = notaInterna; }
    }

}