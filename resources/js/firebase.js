// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getPerformance } from "firebase/performance";

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyB2Cm_Fve-UOhiLnJvKHzXvnZUihB7Xab8",
    authDomain: "ukmcitra-system.firebaseapp.com",
    projectId: "ukmcitra-system",
    storageBucket: "ukmcitra-system.appspot.com",
    messagingSenderId: "672682033682",
    appId: "1:672682033682:web:252c95f416abdeb7ff0ecb",
    measurementId: "G-EG25QTZSV6"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const perf = getPerformance(app);
