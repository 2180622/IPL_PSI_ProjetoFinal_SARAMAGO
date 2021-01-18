package com.example.saramago.vistas.catalogo;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;
import android.widget.Spinner;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SaramagoBDHelper;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.LeitoresJsonParser;
import com.example.saramago.utils.ObrasJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

public class AddObraActivity extends AppCompatActivity implements DatePickerDialog.OnDateSetListener {

    private EditText et_titulo, et_resumo, et_editor, et_ano, et_descricao, et_local, et_edicao, et_assuntos, et_dataRegisto, et_cdu_id, et_colecao_id, et_preco;
    private Obra obra;
    private Spinner sp_tipoObra;
    private final Date date = Calendar.getInstance().getTime();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_obra);

        et_titulo = findViewById(R.id.et_fo_tituloAdd);
        sp_tipoObra = (Spinner) findViewById(R.id.sp_fo_tipoObraAdd);
        // Create an ArrayAdapter using the string array and a default spinner layout
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.tipo_obra_array, android.R.layout.simple_spinner_item);
        // Specify the layout to use when the list of choices appears
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        // Apply the adapter to the spinner
        sp_tipoObra.setAdapter(adapter);



        et_resumo = findViewById(R.id.et_fo_resumoAdd);
        et_editor = findViewById(R.id.et_fo_editorAdd);
        et_ano = findViewById(R.id.et_fo_anoAdd);
        et_descricao = findViewById(R.id.et_fo_descricaoAdd);
        et_local = findViewById(R.id.et_fo_localAdd);
        et_edicao = findViewById(R.id.et_fo_edicaoAdd);
        et_assuntos = findViewById(R.id.et_fo_assuntosAdd);
        et_dataRegisto = findViewById(R.id.et_fo_dataRegistoAdd);
        et_cdu_id = findViewById(R.id.et_fo_cdu_idAdd);
        et_colecao_id = findViewById(R.id.et_fo_colecao_idAdd);
        et_preco = findViewById(R.id.et_fo_precoAdd);
        FloatingActionButton fabAdd = findViewById(R.id.fabSave);

        Toast.makeText(getApplicationContext(), R.string.FillAllFields, Toast.LENGTH_LONG).show();


        et_dataRegisto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                datePickerDialogShow();
            }
        });

        fabAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(ObrasJsonParser.isConnectionInternet(getApplicationContext())){
                    obra = new Obra(0, "noimage", Integer.parseInt(et_ano.getText().toString()), Integer.parseInt(et_preco.getText().toString()), Integer.parseInt(et_cdu_id.getText().toString()), Integer.parseInt(et_colecao_id.getText().toString()), et_titulo.getText().toString(),
                            et_resumo.getText().toString(), et_editor.getText().toString(), sp_tipoObra.getSelectedItem().toString(), et_descricao.getText().toString(),
                            et_local.getText().toString(), et_edicao.getText().toString(), et_assuntos.getText().toString(),
                            et_dataRegisto.getText().toString(), date.toString());

                    SingletonGestorBiblioteca.getInstance(getApplicationContext()).adicionarObraAPI(obra, getApplicationContext());
                    setResult(RESULT_OK);
                    finish();
                }else{
                    Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    private void datePickerDialogShow(){
        DatePickerDialog datePickerDialog = new DatePickerDialog(this, this,
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

    private Date getDate(){
        Date dataAtual = null;

        SimpleDateFormat df = new SimpleDateFormat("dd/MM/yyyy", Locale.getDefault());
        try {
            dataAtual = df.parse(date.toString());
        } catch (ParseException e) {
            e.printStackTrace();
        }

        return dataAtual;
    }
}