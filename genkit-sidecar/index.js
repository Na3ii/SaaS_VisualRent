import express from 'express';

const app = express();
app.use(express.json());

app.get('/health', (req, res) => {
  res.json({ status: 'ok', service: 'genkit-sidecar' });
});

const PORT = process.env.PORT || 4000;
app.listen(PORT, () => {
  console.log(`Genkit Sidecar iniciado en el puerto ${PORT}`);
});
