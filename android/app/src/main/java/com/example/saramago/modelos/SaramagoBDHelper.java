package com.example.saramago.modelos;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

public class SaramagoBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME = "saramagoBD" ;
    private static final int DB_VERSION = 1;

    //region shared Declaration
    private static final String NOME="nome";
    private static final String TIPO = "tipo";
    private static final String MORADA="morada";
    private static final String LOCALIDADE="localidade";
    private static final String DESIGNACAO = "designacao";
    private static final String ESTATUTO = "estatuto";
    private static final String COD_POSTAL="codPostal";
    private static final String COD_BARRAS="codBarras";
    private static final String DATA_REGISTO = "dataRegisto";
    private static final String DATA_ATUALIZADO = "dataAtualizado";
    private static final String LEITOR_ID = "Leitor_id";
    private static final String BIBLIOTECA_ID="Biblioteca_id";
    private static final String OBRA_ID = "Obra_id";
    private static final String EXEMPLAR_ID = "Exemplar_Id";
    //endregion

    //region Declaration user
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

    //region Declaration leitoruser
    public static final String TABLE_LEITOR_USER = "leitoruser";
    private static final String ID_LEITOR="id";
    //endregion

    //region Declaration leitor
    private static final String TABLE_LEITOR = "leitor";
    private static final String NIF="nif";
    private static final String DOC_ID="docId";
    private static final String DATA_NASC="dataNasc";
    private static final String TELEMOVEL="telemovel";
    private static final String TELEFONE="telefone";
    private static final String MAIL2="mail2";
    private static final String NOTAINTERNA="notaInterna";
    private static final String TIPOLEITOR_ID="TipoLeitor_id";
    private static final String USER_ID="User_id";

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
    private static final String TABLE_TIPO_LEITOR = "tipoLeitor";
    private static final String ID_TIPOLEITOR="id";
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
    private static final String DATA_FECHO = "dataFecho";
    private static final String NOTA_RESERVA = "notaReserva";
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
    private static final String SUPLEMENTO = "suplemento";
    private static final String ESTADO = "estado";
    private static final String NOTA_INTERNA = "notaInterna";
    private static final String ESTATUTO_EXEMPLAR_ID = "EstatutoExemplar_id";
    private static final String TIPO_EXEMPLAR_ID = "TipoExemplar_id";
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
    private static final String CDU_ID = "Cdu_id";
    private static final String COLECAO_ID = "Colecao_id";
    //endregion

    //region Declaration
    private static final String LEVANTAMENTO = "levantamento";
    //private static final String COLECAO_ID = "Colecao_id";

    private static final String IDIOMA = "idioma";

    private static final String VOLUME = "volume";
    private static final String PAGINAS = "paginas";
    private static final String ISBN = "isbn";

    private static final String SERIE = "serie";
    private static final String NUMERO = "numero";
    private static final String ISNN = "isnn";

    private static final String DURACAO = "duracao";
    private static final String EAN = "EAN";
    //endregion

    //region Declaration estatutoexemplar
    private static final String TABLE_ESTATUTO_EXEMPLAR = "estatutoexemplar";
    private static final String ID_ESTATUTO_EXEMPLAR = "id";
    private static final String PRAZO = "prazo";
    //endregion

    //region Declatarion tipoexemplar
    private static final String TABLE_TIPO_EXEMPLAR = "tipoexemplar";
    private static final String ID_TIPO_EXEMPLAR = "id";
    //endregion

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
        /*String createTableUser = "CREATE TABLE "+TABLE_USER+" ( "+
                ID_USER+" INTEGER PRIMARY KEY, "+
                USERNAME+" TEXT NOT NULL, "+
                AUTH_KEY+" TEXT NOT NULL, "+
                PASSWORD_HASH+" TEXT NOT NULL, "+
                EMAIL+" TEXT NOT NULL, "+
                STATUS+" INTEGER NOT NULL, "+
                DATA_REGISTO+" TEXT NOT NULL, "+
                DATA_ATUALIZADO+" TEXT NOT NULL);";
        db.execSQL(createTableUser);*/
        //endregion

        //region Create LeitorUser Table
        String createTableLeitorUser = "CREATE TABLE " + TABLE_LEITOR_USER + " ( "+
                ID_LEITOR+" INTEGER PRIMARY KEY, "+
                NOME+" TEXT NOT NULL, "+
                USERNAME+" TEXT NOT NULL, "+
                COD_BARRAS+" TEXT NOT NULL, "+
                NIF+" TEXT NOT NULL, "+
                DOC_ID+" TEXT NOT NULL, "+
                DATA_NASC+" TEXT NOT NULL, "+
                MORADA+" TEXT NOT NULL, "+
                LOCALIDADE+" TEXT NOT NULL, "+
                COD_POSTAL+" INTEGER NOT NULL, "+
                TELEMOVEL+" INTEGER NOT NULL, "+
                TELEFONE+" INTEGER, "+
                EMAIL+" TEXT NOT NULL, "+
                MAIL2+" TEXT, "+
                DATA_REGISTO+" TEXT NOT NULL, "+
                DATA_ATUALIZADO+" TEXT NOT NULL, "+
                BIBLIOTECA_ID+" INTEGER NOT NULL, "+
                TIPOLEITOR_ID+" INTEGER NOT NULL, " +
                "FOREIGN KEY(BIBLIOTECA_ID) REFERENCES TABLE_BIBLIOTECA(ID_BIBLIOTECA), " +
                "FOREIGN KEY(TIPOLEITOR_ID) REFERENCES TABLE_TIPOLEITOR(ID_TIPOLEITOR))";
        db.execSQL(createTableLeitorUser);
        //endregion

        //region Create Cdu Table

        String createTableCdu = "CREATE TABLE " + TABLE_CDU + "( "+
                ID_CDU+" INTEGER PRIMARY KEY, "+
                COD_CDU + " TEXT NOT NULL, "+
                DESIGNACAO + " TEXT); ";
        db.execSQL(createTableCdu);

        //endregion

        //region Create Colecao Table

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
                EDICAO+" TEXT NOT NULL, "+
                ANO+" INT NOT NULL, "+
                TIPO_OBRA+" TEXT NOT NULL, "+
                DESCRICAO+" TEXT NOT NULL, "+
                LOCAL+" TEXT,"+
                EDITOR+" TEXT, "+
                ASSUNTOS+" TEXT, "+
                PRECO+" INTEGER, "+
                DATA_REGISTO+" DATE NOT NULL, "+
                DATA_ATUALIZADO+" DATE, "+
                CDU_ID +" INTEGER NOT NULL, "+
                COLECAO_ID +" INTEGER,"+
                "FOREIGN KEY(CDU_ID) REFERENCES TABLE_CDU(ID_CDU), " +
                "FOREIGN KEY(COLECAO_ID) REFERENCES TABLE_COLECAO(ID_COLECAO));";
        db.execSQL(createTableObra);

        //endregion

        //region Create Biblioteca Table
        String createTableBiblioteca = "CREATE TABLE " + TABLE_BIBLIOTECA + " ( "+
                ID_BIBLIOTECA+" INTEGER PRIMARY KEY, "+
                COD_BIB+" TEXT NOT NULL, "+
                NOME+" TEXT NOT NULL, "+
                LEVANTAMENTO+" INTEGER NOT NULL );";
        db.execSQL(createTableBiblioteca);
        //endregion

        //region Create TipoLeitor Table
        String createTableTipoLeitor = "CREATE TABLE " + TABLE_TIPO_LEITOR + " ( "+
                ID_TIPOLEITOR+" INTEGER PRIMARY KEY, "+
                ESTATUTO+" TEXT NOT NULL, "+
                TIPO+" TEXT NOT NULL, "+
                NITENS+" INTEGER NOT NULL, "+
                PRAZODIAS+" INTEGER NOT NULL, "+
                REGISTOOPAC+" INTEGER NOT NULL);";
        db.execSQL(createTableTipoLeitor);
        //endregion

        //region Create Requisicao Table
        /*String createTableRequisicao = "CREATE TABLE " + TABLE_REQUISICAO + " ( "+
                ID_REQUISICAO+" INTEGER PRIMARY KEY, "+
                DATA_EMPRESTIMO+" TEXT NOT NULL, " +
                ENTREGA_PREVISTA+" TEXT NOT NULL, "+
                DATA_DEVOLUCAO+" TEXT, "+
                RENOVACOES+" INTEGER NOT NULL, "+
                LEITOR_ID+" INTEGER NOT NULL, "+
                "FOREIGN KEY(LEITOR_ID) REFERENCES TABLE_LEITOR(ID_LEITOR))";
        db.execSQL(createTableRequisicao);*/
        //endregion

        //region Create Reserva Table
        /*String createTableReserva = "CREATE TABLE " + TABLE_RESERVA + " ( "+
                ID_RESERVA+" INTEGER PRIMARY KEY, "+
                DATA_RESERVA+" TEXT, "+
                ESTADO_RESERVA+" TEXT, "+
                DATA_FECHO+" TEXT, "+
                NOTA_RESERVA+" TEXT, "+
                LEITOR_ID+" INTEGER NOT NULL, "+
                EXEMPLAR_ID+" INTEGER NOT NULL, "+
                "FOREIGN KEY(LEITOR_ID) REFERENCES TABLE_LEITOR(ID_LEITOR), " +
                "FOREIGN KEY(EXEMPLAR_ID) REFERENCES TABLE_EXEMPLAR(ID_EXEMPLAR))";
        db.execSQL(createTableReserva);*/
        //endregion

        //region Create EstatutoExemplar Table
        /*String createTableEstatutoExemplar = "CREATE TABLE " + TABLE_ESTATUTO_EXEMPLAR + " ( "+
                ID_ESTATUTO_EXEMPLAR+" INTEGER PRIMARY KEY, "+
                ESTATUTO+" TEXT NOT NULL, "+
                PRAZO+" INTEGER );";
        db.execSQL(createTableEstatutoExemplar);*/
        //endregion

        //region Create TipoExemplar Table
        /*String createTableTipoExemplar = "CREATE TABLE " + TABLE_TIPO_EXEMPLAR + " ( "+
                ID_TIPO_EXEMPLAR+" INTEGER PRIMARY KEY, "+
                DESIGNACAO+" TEXT NOT NULL, "+
                TIPO+" TEXT NOT NULL );";
        db.execSQL(createTableTipoExemplar);*/
        //endregion

        //region Create Exemplar Table
        /*String createTableExemplar = "CREATE TABLE " + TABLE_EXEMPLAR + " ( "+
                ID_EXEMPLAR+" INTEGER PRIMARY KEY, "+
                COTA+" TEXT NOT NULL, "+
                COD_BARRAS+" TEXT NOT NULL, "+
                SUPLEMENTO+" INTEGER NOT NULL, "+
                ESTADO+" TEXT NOT NULL, "+
                NOTA_INTERNA+" TEXT, "+
                BIBLIOTECA_ID+" INTEGER NOT NULL, "+
                ESTATUTO_EXEMPLAR_ID+" INTEGER NOT NULL, "+
                TIPO_EXEMPLAR_ID+" INTEGER NOT NULL, "+
                OBRA_ID+" INTEGER NOT NULL, "+
                "FOREIGN KEY(BIBLIOTECA_ID) REFERENCES TABLE_BIBLIOTECA(ID_BIBLIOTECA), " +
                //"FOREIGN KEY(ESTATUTO_EXEMPLAR_ID) REFERENCES TABLE_ESTATUTO_EXEMPLAR(ID_ESTATUTO_EXEMPLAR), " +
                //"FOREIGN KEY(TIPO_EXEMPLAR_ID) REFERENCES TABLE_TIPO_EXEMPLAR(ID_TIPO_EXEMPLAR), " +
                "FOREIGN KEY(OBRA_ID) REFERENCES TABLE_OBRA(ID_OBRA))";
        db.execSQL(createTableExemplar);*/
        //endregion

        //region Create Config Table
        String createTableConfig = "CREATE TABLE " + TABLE_CONFIG + " ( "+
                KEY_CONFIG + " TEXT PRIMARY KEY, "+
                VALUE_CONFIG + " TEXT NOT NULL ); ";
        db.execSQL(createTableConfig);
        //endregion
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        String deleteTableLeitorUser="DROP TABLE IF EXISTS "+TABLE_LEITOR_USER;
        db.execSQL(deleteTableLeitorUser);

        String deleteTableCDU = "DROP TABLE IF EXISTS "+TABLE_CDU;
        db.execSQL(deleteTableCDU);

        String deleteTableColecao = "DROP TABLE IF EXISTS "+TABLE_COLECAO;
        db.execSQL(deleteTableColecao);

        String deleteTableObra = "DROP TABLE IF EXISTS "+TABLE_OBRA;
        db.execSQL(deleteTableObra);

        String deleteTableBiblioteca = "DROP TABLE IF EXISTS "+TABLE_BIBLIOTECA;
        db.execSQL(deleteTableBiblioteca);

        String deleteTableTipoLeitor = "DROP TABLE IF EXISTS "+TABLE_TIPO_LEITOR;
        db.execSQL(deleteTableTipoLeitor);

        String deleteTableConfig = "DROP TABLE IF EXISTS "+TABLE_CONFIG;
        db.execSQL(deleteTableConfig);

        this.onCreate(db);
    }

    //region CRUD leitor
    public void adicionarLeitorBD(Leitor leitor){
        ContentValues values=new ContentValues();
        values.put(ID_LEITOR, leitor.getId());
        values.put(NOME, leitor.getNome());
        values.put(USERNAME, leitor.getUsername());
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

        this.db.insert(TABLE_LEITOR_USER,null,values);
    }
    public boolean editarLeitorBD(Leitor leitor) {
        ContentValues values=new ContentValues();
        values.put(ID_LEITOR, leitor.getId());
        values.put(NOME, leitor.getNome());
        values.put(USERNAME, leitor.getUsername());
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

        int nRows=this.db.update(TABLE_LEITOR_USER,values, "id = ?", new String[]{leitor.getId()+""});

        return (nRows>0);
    }

    public void removerAllLeitoresBD(){
        this.db.delete(TABLE_LEITOR_USER,null,null);
    }

    public boolean removerLeitorBD(int id){
        int nRows=this.db.delete(TABLE_LEITOR_USER,"id = ?", new String[]{id+""});
        return (nRows>0);
    }

    public ArrayList<Leitor> getAllLeitoresBD(){
        ArrayList<Leitor> leitores =new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_LEITOR_USER,new String[]{ID_LEITOR,NOME,USERNAME,COD_BARRAS,NIF,DOC_ID,DATA_NASC,MORADA,LOCALIDADE,COD_POSTAL,TELEMOVEL,TELEFONE,EMAIL,MAIL2,DATA_REGISTO,DATA_ATUALIZADO,BIBLIOTECA_ID,TIPOLEITOR_ID},
                null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                Leitor auxLeitor =new Leitor(cursor.getInt(0),
                        cursor.getString(1), cursor.getString(2),
                        cursor.getString(3),
                        cursor.getInt(4),cursor.getString(5),
                        cursor.getString(6),cursor.getString(7),
                        cursor.getString(8),cursor.getInt(9),
                        cursor.getInt(10),cursor.getInt(11),
                        cursor.getString(12),cursor.getString(13),
                        cursor.getString(14),cursor.getString(15),
                        cursor.getInt(16),cursor.getInt(17));
                leitores.add(auxLeitor);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return leitores;
    }
    //endregion

    //region CRUD user
    public ArrayList<User> getAllUsersBD(){
        ArrayList<User> users =new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_USER,new String[]{ID_USER,USERNAME,AUTH_KEY,PASSWORD_HASH,EMAIL,STATUS,DATA_REGISTO,DATA_ATUALIZADO},
                null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                User auxUser =new User(cursor.getInt(0),
                        cursor.getString(1), cursor.getString(2),
                        cursor.getString(3),cursor.getString(4),
                        cursor.getInt(5),cursor.getInt(6),
                        cursor.getInt(7));
                users.add(auxUser);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return users;
    }
    public void adicionarUserBD(User user){
        ContentValues values=new ContentValues();
        values.put(ID_LEITOR, user.getId());
        values.put(USERNAME, user.getUsername());
        values.put(AUTH_KEY, user.getAuth_key());
        values.put(PASSWORD_HASH, user.getPassword_hash_());
        values.put(EMAIL, user.getEmail());
        values.put(STATUS, user.getStatus());
        values.put(DATA_REGISTO, user.getCreated_at());
        values.put(DATA_ATUALIZADO, user.getUpdated_at());
        this.db.insert(TABLE_USER,null,values);
    }
    public void removerAllUsersBD(){
        this.db.delete(TABLE_USER,null,null);
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

    public boolean editarObraBD(Obra obra) {
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

        int nRows=this.db.update(TABLE_OBRA,values, "id = ?", new String[]{obra.getId()+""});

        return (nRows>0);
    }


    public void removerAllObrasBD(){
        this.db.delete(TABLE_OBRA,null,null);
    }

    public boolean removerObraBD(int id){
        int nRows=this.db.delete(TABLE_OBRA,"id = ?", new String[]{id+""});
        return (nRows>0);
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
                        cursor.getInt(5),cursor.getString(6),
                        cursor.getString(7),cursor.getString(8),
                        cursor.getString(9),cursor.getString(10),
                        cursor.getString(11),cursor.getString(12),
                        cursor.getString(13),cursor.getString(14),
                        cursor.getString(15));
                obras.add(auxObra);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return obras;
    }
    //endregion

    //region config
    public void removerConfigBD(){
        this.db.delete(TABLE_CONFIG,null,null);
    }

    public void adicionarConfigBD(Config config){
        ContentValues values=new ContentValues();
        values.put(KEY_CONFIG, config.getKey());
        values.put(VALUE_CONFIG, config.getValue());

        this.db.insert(TABLE_CONFIG,null,values);
    }

    public ArrayList<Config> getAllConfigBD()
    {
        ArrayList<Config> configs =new ArrayList<>();
        Cursor cursor=this.db.query(TABLE_CONFIG,new String[]{KEY_CONFIG, VALUE_CONFIG},
                null,null,null,null,null);

        if(cursor.moveToFirst()){
            do{
                Config auxConfig = new Config(cursor.getString(0), cursor.getString(1));

                configs.add(auxConfig);
            }while(cursor.moveToNext());
        }
        cursor.close();

        return configs;
    }
    //endregion

    public String getEntidadeBD() //FIXME
    {
        String entidade = null;
        Cursor cursor = this.db.query(TABLE_OBRA,new String[]{KEY_CONFIG, VALUE_CONFIG}, KEY_CONFIG+"= entidade_designacao",null,null,null,null);

        if  (cursor.moveToFirst()) {
            do {
                entidade = cursor.getString(cursor.getColumnIndex(VALUE_CONFIG));
            }while (cursor.moveToNext());
        }

        cursor.close();

        return entidade;

    }
}