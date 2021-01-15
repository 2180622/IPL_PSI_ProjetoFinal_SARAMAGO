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
    private static final String ID="id";
    private static final String LEITOR_ID = "Leitor_id";
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
    //endregion

    //region Declaration leitor
    private static final String TABLE_LEITOR = "leitor";
    //private static final String COD_BARRAS="codBarras";
    private static final String NOME="nome";
    private static final String NIF="nif";
    private static final String DOC_ID="docId";
    private static final String DATA_NASC="dataNasc";
    //private static final String MORADA="morada";
    //private static final String LOCALIDADE="localidade";
    //private static final String COD_POSTAL="codPostal";
    private static final String TELEMOVEL="telemovel";
    private static final String TELEFONE="telefone";
    private static final String MAIL2="mail2";
    private static final String NOTA="notaInterna";
    //private static final String DATA_REGISTO="dataRegisto";
    //private static final String DATA_ATUALIZADO="dataAtualizado";
    private static final String BIBLIOTECA_ID="Biblioteca_id"; //Todo
    private static final String TIPOLEITOR_ID="TipoLeitor_id"; //Todo
    private static final String USER_ID="User_id"; //Todo

    private static final String NUMERO_ALUNO = "numero";
    private static final String DEP_FUNCIONARIO = "departamento";
    //endregion

    //region Declaration biblioteca
    private static final String TABLE_BIBLIOTECA = "biblioteca";
    private static final String COD_BIB = "codBib";
    //private static final String MORADA = "";
    //private static final String LOCALIDADE = "";
    //private static final String CodPostal ="";
    //endregion

    //region Declaration reserva //TODO FEITO
    private static final String TABLE_RESERVA = "reserva";
    private static final String DATA_RESERVA = "dataReserva";
    private static final String ESTADO_RESERVA = "estadoReserva";
    private static final String DATA_FECHO = "estadoReserva";
    private static final String NOTA_RESERVA = "notaReserva";
    private static final String LEVANTAMENTO = "levantamento";
    //private static final String LEITOR_ID = "Leitor_Id";
    private static final String EXEMPLAR_ID = "Exemplar_Id";
    //endregion

    //region Declaration requesicao
    private static final String TABLE_REQUESICAO = "requesicao";
    private static final String DATA_EMPRESTIMO = "dataEmprestimo";
    private static final String ENTREGA_PRevista = "entregaPrevista";
    private static final String DATA_DEVOLUCAO = "dataDevolucao";
    private static final String RENOVACOES = "renovacoes";
    //endregion

    //region Declaration exemplar
    private static final String TABLE_EXEMPLAR = "exemplar";
    private static final String COTA = "cota";
    private static final String ESTADO = "estado";
    private static final String NOTA_INTERNA = "notaInterna";
    //private static final String COD_BARRAS
    private static final String DESIGNACAO = "designacao";
    private static final String TIPO_EXEMPLAR = "tipoExemplar";
    private static final String FUNDO = "designacao";
    //endregion

    //region Declaration obra
    private static final String TABLE_OBRA = "obra";
    private static final String IMG_CAPA = "imgCapa"; //FIXME
    private static final String TITULO = "titulo";
    private static final String resumo = "resumo";
    private static final String EDITOR = "editor";
    private static final String TIPO_OBRA = "tipoObra";
    private static final String DESCRICAO = "descricao";
    private static final String IDIOMA = "idioma";
    private static final String LOCAL = "local";
    private static final String EDICAO = "edicao";
    //private static final String DATA_REGISTO = "dataRegisto";
    //private static final String DATA_ATUALIZADO = "dataAtualizado";

    private static final String VOLUME = "volume";
    private static final String PAGINAS = "paginas";
    private static final String ISBN = "isbn";

    private static final String SERIE = "serie";
    private static final String NUMERO = "numero";
    private static final String ISNN = "isnn";

    private static final String DURACAO = "duracao";
    private static final String EAN = "EAN";
    //endregion

    //region Declaration Config
    private static final String TABLE_CONFIG = "config";
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
                ID_USER+" INTERGER PRIMARY KEY, "+
                USERNAME+" TEXT NOT NULL, "+
                PASSWORD_HASH+" TEXT NOT NULL, "+
                EMAIL+" TEXT NOT NULL );";
        db.execSQL(createTableUser);
        //endregion

        //region Create Leitor Table
        String createTableLeitor = "CREATE TABLE " + TABLE_LEITOR + " ( "+
                ID+" INTERGER PRIMARY KEY, "+
                NOME+" TEXT NOT NULL, "+
                NIF+" TEXT NOT NULL, "+
                STATUS+" INTEGER NOT NULL, "+
                AUTH_KEY+" TEXT NOT NULL );";

        db.execSQL(createTableLeitor);
        //endregion

        //TODO createTable (...)

        //region Create Config Table
        String createTableConfig = "CREATE TABLE " + TABLE_CONFIG + "( "+
                ID+" INTERGER PRIMARY KEY, "+
                KEY_CONFIG + " TEXT NOT NULL, "+
                VALUE_CONFIG + " TEXT NOT NULL ); ";

        db.execSQL(createTableConfig);
        //endregion
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

        //TODO
    }

    //region CRUD
    public void adicionarLivroBD(Leitor leitor){
        ContentValues values=new ContentValues();
        values.put(ID, leitor.getId());
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
        Cursor cursor=this.db.query(TABLE_LEITOR,new String[]{ID,NOME,COD_BARRAS,NIF,DOC_ID,DATA_NASC,MORADA,LOCALIDADE,COD_POSTAL,TELEMOVEL,TELEFONE,EMAIL,MAIL2,DATA_REGISTO,DATA_ATUALIZADO,BIBLIOTECA_ID,TIPOLEITOR_ID,USER_ID},
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
                        cursor.getInt(13),cursor.getInt(14),
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



}
