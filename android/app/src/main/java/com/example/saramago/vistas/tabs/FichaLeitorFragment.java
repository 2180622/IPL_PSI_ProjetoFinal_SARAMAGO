package com.example.saramago.vistas.tabs;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.saramago.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

public class FichaLeitorFragment extends Fragment {
    public FichaLeitorFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        //FloatingActionButton fabEdit = FloatingActionButton

        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_ficha_leitor, container, false);
    }
}