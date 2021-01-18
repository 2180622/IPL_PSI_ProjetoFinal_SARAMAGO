package com.example.saramago.vistas;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.listeners.ConfigListener;
import com.example.saramago.modelos.Config;
import com.example.saramago.modelos.SaramagoBDHelper;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.vistas.leitores.ListaLeitoresActivity;
import com.example.saramago.vistas.catalogo.ListaObrasActivity;

import java.util.ArrayList;

import static com.example.saramago.vistas.MenuMainActivity.PREF_INFO_USER;
import static com.example.saramago.vistas.MenuMainActivity.USERNAME;

public class Dashboard extends Fragment implements ConfigListener {

    private LinearLayout btn_leitores, btn_catalogo, btn_renovacoes, btn_circulacao, btn_arrumar, btn_reservas, btn_transferencias, btn_postos, btn_reprografia;
    private TextView tvOperador;

    private SaramagoBDHelper saramagoBDHelper;

    public Dashboard() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        //SingletonGestorBiblioteca.getInstance(getContext()).get(this);

        SharedPreferences sharedPrefInfoUser = this.getActivity().getSharedPreferences(PREF_INFO_USER, Context.MODE_PRIVATE);
        String username = sharedPrefInfoUser.getString(USERNAME, "");


        SingletonGestorBiblioteca.getInstance(getContext()).setConfigListener(this);
        SingletonGestorBiblioteca.getInstance(getContext()).getConfigAPI(getContext());

        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_dashboard, container, false);

        TextView tvEntidade = view.findViewById(R.id.tv_entidade);
        //tvEntidade.setText(saramagoBDHelper.getEntidadeBD()); //FIXME

        TextView tvOperador = view.findViewById(R.id.tv_operador);
        tvOperador.setText(String.format("@%s", username));

        LinearLayout btn_leitores = view.findViewById(R.id.btn_leitores);
        LinearLayout btn_catalogo = view.findViewById(R.id.btn_catalogo);

        btn_leitores.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), ListaLeitoresActivity.class);
                startActivity(intent);
            }
        });

        btn_catalogo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), ListaObrasActivity.class);
                startActivity(intent);
            }
        });

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
    }

    @Override
    public void onRefreshConfig(ArrayList<Config> listaConfig) {

    }

}