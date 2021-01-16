package com.example.saramago.modelos;

import android.app.Application;
import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class SaramagoBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "saramagoBD" ;
    private static final int DB_VERSION = 1;

    //region shared Declaration
    private static final String LEITOR_ID = "Leitor_id";
    private static final String NOME="nome";
    private static final String MORADA="morada";
    private static final String LOCALIDADE="localidade";
    private static final String COD_POSTAL="codPostal";
    private static final String COD_BARRAS="codBarras";
    private static final String DATA_REGISTO = "dataRegisto";
    private static final String DATA_ATUALIZADO = "dataAtualizado";
    //endregion

    //region Declaration User
    private static final String TABLE_USER = "user";
    private static final String ID_USER="id";
    private static final String USERNAME="username";
    private static final String EMAIL="email";
    private static final String PASSWORD_HASH = "password_hash";
    private static final String STATUS="status";
    private static final String AUTH_KEY ="auth_key"; //TODO
    private static final String ITEM_NAME = "item_name"; //TODO
    private static final String VERIFICATION_TOKEN = "verification_token";
    //endregion

    //region Declaration leitor
    private static final String TABLE_LEITOR = "leitor";
    private static final String ID_LEITOR="id";
    private static final String NIF="nif";
    private static final String DOC_ID="docId";
    private static final String DATA_NASC="dataNasc";
    private static final String TELEMOVEL="telemovel";
    private static final String TELEFONE="telefone";
    private static final String MAIL2="mail2";
    private static final String NOTAINTERNA="notaInterna";
    private static final String BIBLIOTECA_ID="Biblioteca_id"; //Todo
    private static final String TIPOLEITOR_ID="TipoLeitor_id"; //Todo
    private static final String USER_ID="User_id"; //Todo

    private static final String NUMERO_ALUNO = "numero";
    private static final String DEP_FUNCIONARIO = "departamento";
    //endregion

    //region Declaration biblioteca
    private static final String TABLE_BIBLIOTECA = "biblioteca";
    private static final String ID_BIBLIOTECA="id";
    private static final String COD_BIB = "codBiblioteca";
    private static final String NOTASOPAC = "notasOpac";
    private static final String CODPOSTAL = "codPostal";
    //endregion

    //region Declaration tipoLeitor
    private static final String TABLE_TIPOLEITOR = "tipoLeitor";
    private static final String ID_TIPOLEITOR="id";
    private static final String ESTATUTO = "estatuto";
    private static final String TIPO = "tipo";
    private static final String NITENS = "nItens";
    private static final String PRAZODIAS = "prazoDias";
    private static final String REGISTOOPAC = "registoOpac";
    private static final String NOTAS = "notas";
    //endregion

    //region Declaration reserva //TODO FEITO
    private static final String TABLE_RESERVA = "reserva";
    private static final String ID_RESERVA="id";
    private static final String DATA_RESERVA = "dataReserva";
    private static final String ESTADO_RESERVA = "estadoReserva";
    private static final String DATA_FECHO = "estadoReserva";
    private static final String NOTA_RESERVA = "notaReserva";
    private static final String LEVANTAMENTO = "levantamento";
    //private static final String LEITOR_ID = "Leitor_Id";
    private static final String EXEMPLAR_ID = "Exemplar_Id";
    //endregion

    //region Declaration requisicao
    private static final String TABLE_REQUISICAO = "requisicao";
    private static final String ID_REQUISICAO="id";
    private static final String DATA_EMPRESTIMO = "dataEmprestimo";
    private static final String ENTREGA_PREVISTA = "entregaPrevista";
    private static final String DATA_DEVOLUCAO = "dataDevolucao";
    private static final String RENOVACOES = "renovacoes";
    //endregion

    //region Declaration exemplar
    private static final String TABLE_EXEMPLAR = "exemplar";
    private static final String ID_EXEMPLAR="id";
    private static final String COTA = "cota";
    private static final String ESTADO = "estado";
    private static final String NOTA_INTERNA = "notaInterna";
    //private static final String COD_BARRAS
    private static final String DESIGNACAO = "designacao";
    private static final String TIPO_EXEMPLAR = "tipoExemplar";
    private static final String FUNDO = "designacao";
    //endregion

    //region Declaration cdu

    private static final String TABLE_CDU = "cdu";
    private static final String ID_CDU = "id";
    private static final String COD_CDU = "codCdu";
    // private static final String DESIGNACAO = "designacao";

    //endregion

    //region Declaration colecao

    private static final String TABLE_COLECAO = "colecao";
    private static final String ID_COLECAO = "id";
    private static final String TITULO_COLECAO = "tituloColecao";

    //endregion

    //region Declaration obra
    private static final String TABLE_OBRA = "obra";
    private static final String ID_OBRA="id";
    private static final String IMG_CAPA = "imgCapa"; //FIXME
    private static final String TITULO = "titulo";
    private static final String RESUMO = "resumo";
    private static final String EDITOR = "editor";
    private static final String ANO = "ano";
    private static final String TIPO_OBRA = "tipoObra";
    private static final String DESCRICAO = "descricao";
    private static final String LOCAL = "local";
    private static final String EDICAO = "edicao";
    private static final String ASSUNTOS = "assuntos";
    private static final String PRECO = "preco";
    //private static final String DATA_REGISTO = "dataRegisto";
    //private static final String DATA_ATUALIZADO = "dataAtualizado";
    private static final String CDU_ID = "CDU_ID";
    //endregion

    //region Declaration

    //region Declaration Config
    private static final String TABLE_CONFIG = "config";
    private static final String ID_CONFIG="id";
    private static final String KEY_CONFIG = "key_config";
    private static final String VALUE_CONFIG = "value_config";
    //endregion

    private final SQLiteDatabase db;

    public SaramagoBDHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        this.db=this.getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        //region Create User Table
        String createTableUser = "CREATE TABLE "+TABLE_USER+" ( "+
                ID_USER+" INTEGER PRIMARY KEY, "+
                USERNAME+" TEXT NOT NULL, "+
                AUTH_KEY+" TEXT NOT NULL, "+
                PASSWORD_HASH+" TEXT NOT NULL, "+
                EMAIL+" TEXT NOT NULL, "+
                STATUS+" INTEGER NOT NULL, "+
                DATA_REGISTO+" INTEGER NOT NULL, "+
                DATA_ATUALIZADO+" INTEGER NOT NULL, "+
                VERIFICATION_TOKEN+" TEXT );";
        db.execSQL(createTableUser);
        //endregion

        //region Create Leitor Table
        String createTableLeitor = "CREATE TABLE " + TABLE_LEITOR + " ( "+
                ID_LEITOR+" INTEGER PRIMARY KEY, "+
                COD_BARRAS+" TEXT NOT NULL, "+
                NOME+" TEXT NOT NULL, "+
                NIF+" TEXT NOT NULL, "+
                DOC_ID+" TEXT NOT NULL, "+
                DATA_NASC+" DATE NOT NULL, "+
                MORADA+" TEXT NOT NULL, "+
                LOCALIDADE+" TEXT NOT NULL, "+
                COD_POSTAL+" INTEGER NOT NULL, "+
                TELEMOVEL+" INTEGER NOT NULL, "+
                TELEFONE+" INTEGER NOT NULL, "+
                MAIL2+" TEXT, "+
                NOTA_INTERNA+" TEXT, "+
                DATA_REGISTO+" DATE NOT NULL, "+
                DATA_ATUALIZADO+" DATE, "+
                BIBLIOTECA_ID+" INTEGER NOT NULL, "+
                TIPOLEITOR_ID+" INTEGER NOT NULL, "+
                USER_ID+" INTEGER NOT NULL, " +
                "FOREIGN KEY(BIBLIOTECA_ID) REFERENCES TABLE_BIBLIOTECA(ID_BIBLIOTECA), " +
                "FOREIGN KEY(TIPOLEITOR_ID) REFERENCES TABLE_TIPOLEITOR(ID_TIPOLEITOR), " +
                "FOREIGN KEY(USER_ID) REFERENCES TABLE_USER(ID_USER))";
        db.execSQL(createTableLeitor);
        //endregion

        //region Create Cdu Table

        String createTableCdu = "CREATE TABLE " + TABLE_CDU + "( "+
                ID_CDU+" INTEGER PRIMARY KEY, "+
                COD_CDU + " TEXT NOT NULL, "+
                DESIGNACAO + " TEXT); ";
        db.execSQL(createTableCdu);

        //endregion

        //region Create Cdu Table

        String createTableColecao = "CREATE TABLE " + TABLE_COLECAO + "( "+
                ID_COLECAO + " INTEGER PRIMARY KEY, "+
                TITULO_COLECAO + " TEXT NOT NULL); ";
        db.execSQL(createTableColecao);

        //endregion

        //region Create Obra Table

        String createTableObra = "CREATE TABLE " + TABLE_OBRA + " ( "+
                ID_OBRA+" INTEGER PRIMARY KEY, "+
                IMG_CAPA+" TEXT, "+
                TITULO+" TEXT NOT NULL, "+
                RESUMO+" TEXT, "+
                EDITOR+" TEXT NOT NULL, "+
                ANO+" INT NOT NULL, "+
                TIPO_OBRA+" TEXT NOT NULL, "+
                DESCRICAO+" TEXT NOT NULL, "+
                EDITOR+" TEXT, "+
                ASSUNTOS+" TEXT, "+
                PRECO+" TEXT, "+
                DATA_REGISTO+" DATE NOT NULL, "+
                DATA_ATUALIZADO+" DATE, "+
                "FOREIGN KEY(CDU_ID) REFERENCES TABLE_CDU(ID_CDU), " +
                "FOREIGN KEY(COLECAO_ID) REFERENCES TABLE_COLECAO(ID_COLECAO));";
        db.execSQL(createTableObra);

        //endregion

        //region Create Biblioteca Table
        String createTableBiblioteca = "CREATE TABLE " + TABLE_BIBLIOTECA + " ( "+
                ID_BIBLIOTECA+" INTEGER PRIMARY KEY, "+
                COD_BIB+" TEXT NOT NULL, "+
                NOME+" TEXT NOT NULL, "+
                NOTASOPAC+" TEXT, "+
                MORADA+" TEXT, "+
                LOCALIDADE+" TEXT, "+
                COD_POSTAL+" INTEGER, "+
                LEVANTAMENTO+" INTEGER NOT NULL );";
        db.execSQL(createTableBiblioteca);
        //endregion

        //region Create TipoLeitor Table
        String createTableTipoLeitor = "CREATE TABLE " + TABLE_TIPOLEITOR + " ( "+
                ID_TIPOLEITOR+" INTEGER PRIMARY KEY, "+
                ESTATUTO+" TEXT NOT NULL, "+
                TIPO+" TEXT NOT NULL, "+
                NITENS+" INTEGER NOT NULL, "+
                PRAZODIAS+" INTEGER NOT NULL, "+
                REGISTOOPAC+" INTEGER NOT NULL, "+
                NOTAS+" TEXT NOT NULL );";
        db.execSQL(createTableTipoLeitor);
        //endregion

        //region Create Config Table
        String createTableConfig = "CREATE TABLE " + TABLE_CONFIG + "( "+
                ID_CONFIG+" INTEGER PRIMARY KEY, "+
                KEY_CONFIG + " TEXT NOT NULL, "+
                VALUE_CONFIG + " TEXT NOT NULL ); ";

        db.execSQL(createTableConfig);
        //endregion
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

        //TODO
    }

    //region CRUD leitor
    public void adicionarLeitorBD(Leitor leitor){
        ContentValues values=new ContentValues();
        values.put(ID_LEITOR, leitor.getId());
        values.put(NOME, leitor.getNome());
        values.put(COD_BARRAS, leitor.getCodBarras());
        values.put(NIF,leitor.getNif());
        values.put(DOC_ID,leitor.getDocId());
        values.put(DATA_NASC,leitor.getDataNasc());
        values.put(MORADA,leitor.getMorada());
        values.put(LOCALIDADE,leitor.getLocalidade());
        values.put(COD_POSTAL,leitor.getCodPostal());
        values.put(TELEMOVEL,leitor.getTelemovel());
        values.put(TELEFONE,leitor.getTelefone());
        values.put(EMAIL,leitor.getEmail());
        values.put(MAIL2,leitor.getMail2());
        values.put(DATA_REGISTO,leitor.getDataRegisto());
        values.put(DATA_ATUALIZADO,leitor.getDataAtualizado());
        values.put(BIBLIOTECA_ID,leitor.getBiblioteca_id());
        values.put(TIPOLEITOR_ID,leitor.getTipoLeitor_Id());
        values.put(USER_ID,leitor.getUser_id());

        this.db.insert(TABLE_LEITOR,null,values);
    }
    public void removerAllLeitoresBD(){
        this.db.delete(TABLE_LEITOR,null,null);
    }

    public ArrayList<Leitor> getAllLeitoresBD(){
        ArrayList<Leitor> leitores =new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_LEITOR,new String[]{ID_LEITOR,NOME,COD_BARRAS,NIF,DOC_ID,DATA_NASC,MORADA,LOCALIDADE,COD_POSTAL,TELEMOVEL,TELEFONE,EMAIL,MAIL2,DATA_REGISTO,DATA_ATUALIZADO,BIBLIOTECA_ID,TIPOLEITOR_ID,USER_ID},
                null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                Leitor auxLeitor =new Leitor(cursor.getInt(0),
                        cursor.getString(1), cursor.getString(2),
                        cursor.getInt(3),cursor.getString(4),
                        cursor.getString(5),cursor.getString(6),
                        cursor.getString(7),cursor.getInt(8),
                        cursor.getInt(9),cursor.getInt(10),
                        cursor.getString(11),cursor.getString(12),
                        cursor.getString(13),cursor.getString(14),
                        cursor.getInt(15),cursor.getInt(16),
                        cursor.getInt(17));
                // auxLivro.setId(cursor.getInt(0));
                leitores.add(auxLeitor);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return leitores;
    }
    //endregion




    //region CRUD obra
    public void adicionarObraBD(Obra obra){
        ContentValues values=new ContentValues();
        values.put(ID_OBRA,obra.getId());
        values.put(IMG_CAPA,obra.getImgCapa());
        values.put(TITULO,obra.getTitulo());
        values.put(RESUMO,obra.getResumo());
        values.put(EDITOR,obra.getEditor());
        values.put(ANO,obra.getAno());
        values.put(TIPO_OBRA,obra.getTipoObra());
        values.put(DESCRICAO,obra.getDescricao());
        values.put(LOCAL,obra.getLocal());
        values.put(EDICAO,obra.getEdicao());
        values.put(ASSUNTOS,obra.getAssuntos());
        values.put(PRECO,obra.getPreco());
        values.put(CDU_ID,obra.getCdu_id());
        values.put(DATA_REGISTO,obra.getDataRegisto());
        values.put(DATA_ATUALIZADO,obra.getDataAtualizado());

        this.db.insert(TABLE_OBRA,null,values);
    }
    public void removerAllObrasBD(){
        this.db.delete(TABLE_OBRA,null,null);
    }

    public ArrayList<Obra> getAllObrasBD(){
        ArrayList<Obra> obras =new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_OBRA,new String[]{ID_OBRA,IMG_CAPA,TITULO,RESUMO,EDITOR,ANO,TIPO_OBRA,DESCRICAO,LOCAL,EDICAO,ASSUNTOS,PRECO,CDU_ID,DATA_REGISTO,DATA_ATUALIZADO},
                null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                Obra auxObra =new Obra(cursor.getInt(0),
                        cursor.getString(1), cursor.getInt(2),
                        cursor.getInt(3),cursor.getInt(4),
                        cursor.getString(5),cursor.getString(6),
                        cursor.getString(7),cursor.getString(8),
                        cursor.getString(9),cursor.getString(10),
                        cursor.getString(11),cursor.getString(12),
                        cursor.getString(13),cursor.getString(14));
                // auxLivro.setId(cursor.getInt(0));
                obras.add(auxObra);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return obras;
    }
    //endregion



}
