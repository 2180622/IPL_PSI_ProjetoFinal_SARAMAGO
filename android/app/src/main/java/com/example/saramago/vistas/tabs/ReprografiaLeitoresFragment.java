package com.example.saramago.vistas.tabs;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.saramago.R;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link ReprografiaLeitoresFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class ReprografiaLeitoresFragment extends Fragment {
    public ReprografiaLeitoresFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_reprografia_leitores, container, false);
    }
}