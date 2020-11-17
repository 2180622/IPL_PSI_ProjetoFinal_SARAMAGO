package com.example.saramago.vistas;

import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.example.saramago.R;

public class Dashboard extends Fragment {

    private LinearLayout btn_leitores, btn_catalogo, btn_renovacoes, btn_circulacao, btn_arrumar, btn_reservas, btn_transferencias, btn_postos, btn_reprografia;
    private TextView tvOperador;

    public Dashboard() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_dashboard, container, false);

        TextView tvOperador = getActivity().findViewById(R.id.tv_operador);

        return view;
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        LinearLayout btn_leitores = getActivity().findViewById(R.id.btn_leitores);
        LinearLayout btn_catalogo = getActivity().findViewById(R.id.btn_catalogo);
        LinearLayout btn_renovacoes = getActivity().findViewById(R.id.btn_renovacoes);
        LinearLayout btn_circulacao = getActivity().findViewById(R.id.btn_circulacao);
        LinearLayout btn_arrumar = getActivity().findViewById(R.id.btn_arrumar);
        LinearLayout btn_reservas = getActivity().findViewById(R.id.btn_reservas);
        LinearLayout btn_transferencias = getActivity().findViewById(R.id.btn_transferencias);
        LinearLayout btn_postos = getActivity().findViewById(R.id.btn_postos);
        LinearLayout btn_reprografia = getActivity().findViewById(R.id.btn_reprografia);

        TextView tvOperador = getActivity().findViewById(R.id.tv_operador);

        btn_leitores.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tvOperador.setText("TESTE TESTE");
            }
        });
    }
}