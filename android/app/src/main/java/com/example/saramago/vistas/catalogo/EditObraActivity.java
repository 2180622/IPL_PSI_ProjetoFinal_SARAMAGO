package com.example.saramago.vistas.catalogo;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;

import androidx.appcompat.app.AppCompatActivity;

import com.example.saramago.R;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.Calendar;
import java.util.Date;

public class EditObraActivity extends AppCompatActivity implements DatePickerDialog.OnDateSetListener{

    private EditText et_titulo, et_resumo, et_editor, et_ano, et_descricao, et_local, et_edicao, et_assuntos, et_dataRegisto, et_cdu_id, et_colecao_id, et_preco;
    private Obra obra;
    private Spinner sp_tipoObra;
    private final Date date = Calendar.getInstance().getTime();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_obra);

        et_titulo = findViewById(R.id.et_fo_tituloEdit);
        sp_tipoObra = findViewById(R.id.sp_fo_tipoObraEdit);
        et_resumo = findViewById(R.id.et_fo_resumoEdit);
        et_editor = findViewById(R.id.et_fo_editorEdit);
        et_ano = findViewById(R.id.et_fo_anoEdit);
        et_descricao = findViewById(R.id.et_fo_descricaoEdit);
        et_local = findViewById(R.id.et_fo_localEdit);
        et_edicao = findViewById(R.id.et_fo_edicaoEdit);
        et_assuntos = findViewById(R.id.et_fo_assuntosEdit);
        et_dataRegisto = findViewById(R.id.et_fo_dataRegistoEdit);
        et_cdu_id = findViewById(R.id.et_fo_cdu_idEdit);
        et_colecao_id = findViewById(R.id.et_fo_colecao_idEdit);
        et_preco = findViewById(R.id.et_fo_precoEdit);
        FloatingActionButton fabSave = findViewById(R.id.fabSave);

        if(obra != null){
            carregarConteudoObra();
        }

        et_dataRegisto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                datePickerDialogShow();
            }
        });

        fabSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                /*leitor = new Leitor(nome.getText().toString(), R.drawable.ic_undraw_male_avatar, codBarras.getText().toString(),
                        Integer.parseInt(nif.getText().toString()), docId.getText().toString(), dtaNascimento.getText().toString(), morada.getText().toString(), localidade.getText().toString(),
                        Integer.parseInt(codPostal.getText().toString()), Integer.parseInt(telemovel.getText().toString()), Integer.parseInt(telefone.getText().toString()), email.getText().toString(),
                        email2.getText().toString(), date, date, 1, 1);*/
                

                SingletonGestorBiblioteca.getInstance(getApplicationContext()).editarObra(obra);
                setResult(RESULT_OK);
                finish();
            }
        });
    }

    private void datePickerDialogShow(){
        DatePickerDialog datePickerDialog = new DatePickerDialog(this,this,
                Calendar.getInstance().get(Calendar.YEAR),
                Calendar.getInstance().get(Calendar.MONTH),
                Calendar.getInstance().get(Calendar.DAY_OF_MONTH)
        );
        datePickerDialog.show();
    }

    @Override
    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
        String date = year + "/" + month + "/" + dayOfMonth;
        et_dataRegisto.setText(date);
    }

    private void carregarConteudoObra(){
        et_titulo.setText(obra.getTitulo());
        et_resumo.setText(obra.getResumo());
        et_editor.setText(obra.getEditor());
        et_ano.setText(obra.getAno()+"");
        sp_tipoObra.setPrompt(obra.getTipoObra());
        et_descricao.setText(obra.getDescricao());
        et_local.setText(obra.getLocal());
        et_edicao.setText(obra.getEdicao());
        et_assuntos.setText(obra.getAssuntos());
        et_preco.setText(obra.getPreco());
        et_dataRegisto.setText(obra.getDataRegisto());
        et_cdu_id.setText(obra.getCdu_id()+"");
        et_colecao_id.setText(obra.getColecao_id()+"");
    }
}