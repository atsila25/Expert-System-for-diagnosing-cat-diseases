<?php
// koneksi
$conn = mysqli_connect("localhost", "root", "", "sistem_pakar_db");

// Ambil daftar gejala dari database
$query = "SELECT * FROM gejala";
$result = mysqli_query($conn, $query);
$gejala = array();

while ($row = mysqli_fetch_assoc($result)) {
    $gejala[] = $row;
}

// Ambil daftar penyakit dari database
$query = "SELECT * FROM penyakit";
$result = mysqli_query($conn, $query);
$penyakit = array();

while ($row = mysqli_fetch_assoc($result)) {
    $penyakit[] = $row;
}

function forwardChaining($gejala_terpilih, $conn)
{
    if (empty($gejala_terpilih)) {
        // If no symptoms are selected, return an empty array
        return array();
    }

    $penyakit_terdiagnosis = array(); // Array of diagnosed diseases
    $rule_changed = true; // Flag to indicate rule changes

    // Looping until there are no more rule changes or the last disease is reached
    while ($rule_changed) {
        $rule_changed = false;

        // Convert $gejala_terpilih to a string with commas as separators
        $gejala_str = implode(",", $gejala_terpilih);

        // Fetch rules with symptoms matching the selected ones
        $query = "SELECT * FROM aturan WHERE id_gejala IN ($gejala_str)";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            // Check if the disease is not already diagnosed
            if (!in_array($row['id_penyakit'], $penyakit_terdiagnosis)) {
                // If not diagnosed, add it to the diagnosed diseases array
                $penyakit_terdiagnosis[] = $row['id_penyakit'];
                $rule_changed = true;

                // Based on the number of selected symptoms, increase the likelihood of the disease
                switch (count($gejala_terpilih)) {
                    case 1:
                        $penyakit_kemungkinan[$row['id_penyakit']] = 0.5;
                        break;
                    case 2:
                        $penyakit_kemungkinan[$row['id_penyakit']] = 0.7;
                        break;
                    case 3:
                        $penyakit_kemungkinan[$row['id_penyakit']] = 0.9;
                        break;
                    default:
                        $penyakit_kemungkinan[$row['id_penyakit']] = 1;
                }
            }
        }
    }

    // Fetch disease names and solutions from the database
    $hasil_diagnosa = array();

    // Determine the most likely disease based on symptom count and probability
    $most_likely_disease_id = 0;
    $highest_probability = 0;
    foreach ($penyakit_kemungkinan as $id_penyakit => $probability) {
        if ($probability > $highest_probability) {
            $most_likely_disease_id = $id_penyakit;
            $highest_probability = $probability;
        }
    }

    // If there is a most likely disease, add it to the results
    if ($most_likely_disease_id > 0) {
        $query = "SELECT nama FROM penyakit WHERE id = $most_likely_disease_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $nama_penyakit = $row['nama'];

        $query = "SELECT solusi FROM solusi WHERE id_penyakit = $most_likely_disease_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $solusi_penyakit = $row['solusi'];

        $hasil_diagnosa[] = array(
            'nama' => $nama_penyakit,
            'solusi' => $solusi_penyakit
        );
    }

    return $hasil_diagnosa;
}

?>