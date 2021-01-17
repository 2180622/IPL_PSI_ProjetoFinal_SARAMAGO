package com.example.saramago.vistas.leitores;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

public class AddLeitorActivity extends AppCompatActivity implements DatePickerDialog.OnDateSetListener {

    private EditText nome, codBarras, nif, docId, dtaNascimento, morada, localidade, codPostal, telemovel, telefone, email, email2;
    private Leitor leitor;
    private final Date date = Calendar.getInstance().getTime();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_leitor);

        nome = findViewById(R.id.et_fl_nome);
        codBarras = findViewById(R.id.et_fl_codBarras);
        nif = findViewById(R.id.et_fl_nif);
        docId = findViewById(R.id.et_fl_docId);
        dtaNascimento = findViewById(R.id.et_fl_dataNasc);
        morada = findViewById(R.id.et_fl_morada);
        localidade = findViewById(R.id.et_fl_localidade);
        codPostal = findViewById(R.id.et_fl_codPostal);
        telemovel = findViewById(R.id.et_fl_telemovel);
        telefone = findViewById(R.id.tv_fl_telefone);
        email = findViewById(R.id.et_fl_email);
        email2 = findViewById(R.id.et_fl_email2);
        FloatingActionButton fabAdd = findViewById(R.id.fabSave);


        dtaNascimento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                datePickerDialogShow();
            }
        });

        fabAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                leitor = new Leitor(0, nome.getText().toString(), codBarras.getText().toString(),
                        Integer.parseInt(nif.getText().toString()), docId.getText().toString(), dtaNascimento.getText().toString(), morada.getText().toString(), localidade.getText().toString(),
                        Integer.parseInt(codPostal.getText().toString()), Integer.parseInt(telemovel.getText().toString()), Integer.parseInt(telefone.getText().toString()), email2.getText().toString(),
                        date.toString(), date.toString(), 1, 1, 0);

                SingletonGestorBiblioteca.getInstance(getApplicationContext()).adicionarLeitorAPI(leitor, getApplicationContext());
                setResult(RESULT_OK);
                finish();
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
        dtaNascimento.setText(date);
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