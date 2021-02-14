package com.example.saramago.vistas.catalogo;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.saramago.R;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.ObrasJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.Calendar;
import java.util.Date;

public class EditObraActivity extends AppCompatActivity implements DatePickerDialog.OnDateSetListener{

    public static final String ID = "ID";
    private EditText et_titulo, et_resumo, et_editor, et_ano, et_descricao, et_local, et_edicao, et_assuntos, et_dataRegisto, et_cdu_id, et_colecao_id, et_preco;
    private Obra obra;
    private Spinner sp_tipoObra;

    private final Date date = Calendar.getInstance().getTime();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_obra);

        et_titulo = findViewById(R.id.et_fo_tituloEdit);
        sp_tipoObra = (Spinner) findViewById(R.id.sp_fo_tipoObraEdit);
        // Create an ArrayAdapter using the string array and a default spinner layout
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.tipo_obra_array, android.R.layout.simple_spinner_item);
        // Specify the layout to use when the list of choices appears
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        // Apply the adapter to the spinner
        sp_tipoObra.setAdapter(adapter);
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

        int id = getIntent().getIntExtra(ID, -1);
        obra = SingletonGestorBiblioteca.getInstance(getApplicationContext()).getObra(id);

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
                if(ObrasJsonParser.isConnectionInternet(getApplicationContext())) {
                    if (obra != null) {
                        obra.setTitulo(et_titulo.getText().toString());
                        obra.setResumo(et_resumo.getText().toString());
                        obra.setEditor(et_editor.getText().toString());
                        obra.setAno(Integer.parseInt(et_ano.getText().toString()));
                        obra.setDescricao(et_descricao.getText().toString());
                        obra.setLocal(et_local.getText().toString());
                        obra.setEdicao(et_edicao.getText().toString());
                        obra.setAssuntos(et_assuntos.getText().toString());
                        obra.setPreco(Integer.parseInt(et_preco.getText().toString()));
                        obra.setCdu_id(Integer.parseInt(et_cdu_id.getText().toString()));
                        obra.setColecao_id(Integer.parseInt(et_colecao_id.getText().toString()));

                        SingletonGestorBiblioteca.getInstance(getApplicationContext()).editarObraAPI(obra, getApplicationContext());
                        setResult(RESULT_OK);
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_LONG).show();
                    }
                }
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
        et_preco.setText(obra.getPreco()+"");
        et_cdu_id.setText(obra.getCdu_id()+"");
        et_colecao_id.setText(obra.getColecao_id()+"");
    }
}