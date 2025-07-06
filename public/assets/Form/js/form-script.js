document.addEventListener("DOMContentLoaded", () => {
  let currentStep = 1;
  const totalSteps = 4;
  const formData = {};
  const uploadedFiles = {};

  // Initialize form
  initializeForm();

  // Profile dropdown functionality
  const profileBtn = document.getElementById("profile-btn");
  const dropdownMenu = document.getElementById("dropdown-menu");

  profileBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdownMenu.classList.toggle("show");
  });

  document.addEventListener("click", () => {
    dropdownMenu.classList.remove("show");
  });

  dropdownMenu.addEventListener("click", (e) => {
    e.stopPropagation();
  });

  // Form validation
  function validateStep(step) {
    const stepElement = document.getElementById(`step-${step}`);
    const requiredFields = stepElement.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
      clearFieldError(field);
      if (!field.value.trim()) {
        showFieldError(field, "Field ini wajib diisi");
        isValid = false;
      } else {
        // Specific validations
        if (field.id === "nik" && !/^\d{16}$/.test(field.value.trim())) {
          showFieldError(field, "NIK harus 16 digit angka");
          isValid = false;
        } else if (
          field.type === "email" &&
          !isValidEmail(field.value.trim())
        ) {
          showFieldError(field, "Format email tidak valid");
          isValid = false;
        } else {
          showFieldSuccess(field);
        }
      }
    });

    // Step 2 specific validation (file uploads)
    if (step === 2) {
      const requiredUploads = ["kk", "akta", "foto"];
      requiredUploads.forEach((uploadType) => {
        if (!uploadedFiles[uploadType]) {
          const uploadBox = document.querySelector(
            `[data-upload="${uploadType}"]`
          );
          uploadBox.style.borderColor = "#ef4444";
          uploadBox.style.background = "rgba(239, 68, 68, 0.05)";
          isValid = false;
        }
      });
    }

    // Step 3 specific validation (agreement)
    if (step === 3) {
      const agreement = document.getElementById("agreement");
      if (!agreement.checked) {
        showFieldError(agreement, "Anda harus menyetujui pernyataan");
        isValid = false;
      }
    }

    return isValid;
  }

  function showFieldError(field, message) {
    field.classList.add("error");
    field.classList.remove("success");

    // Remove existing error message
    const existingError = field.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }

    // Add error message
    const errorElement = document.createElement("div");
    errorElement.className = "error-message";
    errorElement.textContent = message;
    field.parentElement.appendChild(errorElement);
  }

  function showFieldSuccess(field) {
    field.classList.add("success");
    field.classList.remove("error");

    // Remove existing messages
    const existingError = field.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }
  }

  function clearFieldError(field) {
    field.classList.remove("error", "success");
    const existingError = field.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }
  }

  function isValidEmail(email) {
    const re =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  // File upload functionality
  function initializeFileUploads() {
    const uploadBoxes = document.querySelectorAll(".upload-box");

    uploadBoxes.forEach((box) => {
      const uploadType = box.getAttribute("data-upload");
      const fileInput = document.getElementById(`file-${uploadType}`);

      // Click to upload
      box.addEventListener("click", () => {
        fileInput.click();
      });

      // File input change
      fileInput.addEventListener("change", (e) => {
        handleFileUpload(e.target.files[0], uploadType);
      });

      // Drag and drop
      box.addEventListener("dragover", (e) => {
        e.preventDefault();
        box.classList.add("dragover");
      });

      box.addEventListener("dragleave", () => {
        box.classList.remove("dragover");
      });

      box.addEventListener("drop", (e) => {
        e.preventDefault();
        box.classList.remove("dragover");
        const files = e.dataTransfer.files;
        if (files.length > 0) {
          handleFileUpload(files[0], uploadType);
        }
      });
    });
  }

  function handleFileUpload(file, uploadType) {
    const resultElement = document.getElementById(`result-${uploadType}`);
    const uploadBox = document.querySelector(`[data-upload="${uploadType}"]`);

    // Reset upload box style
    uploadBox.style.borderColor = "";
    uploadBox.style.background = "";

    // Validate file
    const validation = validateFile(file, uploadType);
    if (!validation.valid) {
      showUploadError(resultElement, validation.message);
      return;
    }

    // Simulate file upload
    showUploadProgress(resultElement);

    setTimeout(() => {
      uploadedFiles[uploadType] = {
        file: file,
        name: file.name,
        size: file.size,
        type: file.type,
        uploadDate: new Date(),
      };

      showUploadSuccess(resultElement, file);
    }, 1500);
  }

  function validateFile(file, uploadType) {
    const maxSizes = {
      kk: 2 * 1024 * 1024, // 2MB
      akta: 2 * 1024 * 1024, // 2MB
      nikah: 2 * 1024 * 1024, // 2MB
      foto: 1 * 1024 * 1024, // 1MB
    };

    const allowedTypes = {
      kk: ["application/pdf", "image/jpeg", "image/jpg"],
      akta: ["application/pdf", "image/jpeg", "image/jpg"],
      nikah: ["application/pdf", "image/jpeg", "image/jpg"],
      foto: ["image/jpeg", "image/jpg"],
    };

    if (file.size > maxSizes[uploadType]) {
      return {
        valid: false,
        message: `Ukuran file terlalu besar. Maksimal ${
          maxSizes[uploadType] / (1024 * 1024)
        }MB`,
      };
    }

    if (!allowedTypes[uploadType].includes(file.type)) {
      return {
        valid: false,
        message: "Format file tidak didukung",
      };
    }

    return { valid: true };
  }

  function showUploadProgress(resultElement) {
    resultElement.className = "upload-result";
    resultElement.style.display = "block";
    resultElement.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.5rem;">
          <div class="loading-spinner" style="width: 20px; height: 20px; border-width: 2px;"></div>
          <span>Mengupload file...</span>
        </div>
      `;
  }

  function showUploadSuccess(resultElement, file) {
    resultElement.className = "upload-result success";
    resultElement.innerHTML = `
        <div class="file-info">
          <div class="file-details">
            <i class="fas fa-file-alt"></i>
            <div>
              <div style="font-weight: 600;">${file.name}</div>
              <div style="font-size: 0.75rem; color: #6b7280;">${formatFileSize(
                file.size
              )}</div>
            </div>
          </div>
          <div class="file-actions">
            <button type="button" class="btn-small btn-view" onclick="viewFile('${
              file.name
            }')">
              <i class="fas fa-eye"></i> Lihat
            </button>
            <button type="button" class="btn-small btn-remove" onclick="removeFile('${
              resultElement.id.split("-")[1]
            }')">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </div>
      `;
  }

  function showUploadError(resultElement, message) {
    resultElement.className = "upload-result error";
    resultElement.style.display = "block";
    resultElement.innerHTML = `
        <div style="display: flex; align-items: center; gap: 0.5rem;">
          <i class="fas fa-exclamation-triangle"></i>
          <span>${message}</span>
        </div>
      `;
  }

  function formatFileSize(bytes) {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return (
      Number.parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i]
    );
  }

  // Step navigation
  function updateStepDisplay() {
    // Hide all steps
    document.querySelectorAll(".form-step").forEach((step) => {
      step.classList.remove("active");
    });

    // Show current step
    document.getElementById(`step-${currentStep}`).classList.add("active");

    // Update progress steps
    document.querySelectorAll(".step").forEach((step, index) => {
      const stepNumber = index + 1;
      step.classList.remove("active", "completed");

      if (stepNumber < currentStep) {
        step.classList.add("completed");
      } else if (stepNumber === currentStep) {
        step.classList.add("active");
      }
    });

    // Update navigation buttons
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    prevBtn.style.display = currentStep > 1 ? "flex" : "none";
    nextBtn.style.display = currentStep < totalSteps ? "flex" : "none";
    submitBtn.style.display = currentStep === totalSteps - 1 ? "flex" : "none";

    // Update button text for step 3
    if (currentStep === 3) {
      nextBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pengajuan';
    }
  }

  function collectFormData() {
    const form = document.getElementById("ktp-form");
    const formData = new FormData(form);
    const data = {};

    for (const [key, value] of formData.entries()) {
      data[key] = value;
    }

    return data;
  }

  function populateVerificationData() {
    const personalData = collectFormData();
    const verificationPersonal = document.getElementById(
      "verification-personal"
    );
    const verificationFiles = document.getElementById("verification-files");

    // Populate personal data
    const personalFields = [
      { key: "nik", label: "NIK" },
      { key: "nama-lengkap", label: "Nama Lengkap" },
      { key: "tempat-lahir", label: "Tempat Lahir" },
      { key: "tanggal-lahir", label: "Tanggal Lahir" },
      { key: "jenis-kelamin", label: "Jenis Kelamin" },
      { key: "agama", label: "Agama" },
      { key: "status-perkawinan", label: "Status Perkawinan" },
      { key: "pekerjaan", label: "Pekerjaan" },
      { key: "alamat", label: "Alamat" },
      { key: "rt", label: "RT" },
      { key: "rw", label: "RW" },
      { key: "kelurahan", label: "Kelurahan/Desa" },
      { key: "kecamatan", label: "Kecamatan" },
    ];

    verificationPersonal.innerHTML = personalFields
      .map(
        (field) => `
        <div class="verification-item">
          <strong>${field.label}:</strong>
          <span>${personalData[field.key] || "-"}</span>
        </div>
      `
      )
      .join("");

    // Populate uploaded files
    const fileLabels = {
      kk: "Kartu Keluarga",
      akta: "Akta Kelahiran",
      nikah: "Surat Nikah/Cerai",
      foto: "Pas Foto 4x6",
    };

    verificationFiles.innerHTML = Object.keys(uploadedFiles)
      .map(
        (key) => `
        <div class="file-preview">
          <i class="fas fa-file-alt"></i>
          <h4>${fileLabels[key]}</h4>
          <p>${uploadedFiles[key].name}</p>
          <p>${formatFileSize(uploadedFiles[key].size)}</p>
        </div>
      `
      )
      .join("");
  }

  function initializeForm() {
    initializeFileUploads();
    updateStepDisplay();

    // Form submission
    document.getElementById("ktp-form").addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm();
    });
  }

  function submitForm() {
    if (!validateStep(3)) {
      return;
    }

    // Show loading
    const loadingOverlay = document.getElementById("loading-overlay");
    loadingOverlay.classList.add("show");

    // Simulate form submission
    setTimeout(() => {
      loadingOverlay.classList.remove("show");
      currentStep = 4;
      updateStepDisplay();
      populateSuccessData();
    }, 3000);
  }

  function populateSuccessData() {
    const applicationDate = new Date();
    document.getElementById("application-date").textContent =
      applicationDate.toLocaleDateString("id-ID", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      });
  }

  // Global functions for navigation
  window.nextStep = () => {
    if (currentStep < 3 && !validateStep(currentStep)) {
      return;
    }

    if (currentStep === 3) {
      populateVerificationData();
    }

    if (currentStep < totalSteps) {
      currentStep++;
      updateStepDisplay();
    }
  };

  window.previousStep = () => {
    if (currentStep > 1) {
      currentStep--;
      updateStepDisplay();
    }
  };

  // Global functions for file management
  window.viewFile = (fileName) => {
    alert(`Melihat file: ${fileName}`);
    // In real implementation, this would open a file viewer
  };

  window.removeFile = (uploadType) => {
    if (confirm("Apakah Anda yakin ingin menghapus file ini?")) {
      delete uploadedFiles[uploadType];
      const resultElement = document.getElementById(`result-${uploadType}`);
      resultElement.style.display = "none";
      resultElement.className = "upload-result";

      // Reset upload box
      const uploadBox = document.querySelector(`[data-upload="${uploadType}"]`);
      uploadBox.style.borderColor = "";
      uploadBox.style.background = "";
    }
  };

  // Global functions for success page
  window.downloadReceipt = () => {
    // Simulate file download
    const link = document.createElement("a");
    link.href =
      "data:text/plain;charset=utf-8," +
      encodeURIComponent(
        "Tanda Terima Pengajuan KTP\n\nNomor: KTP-2024-001234\nTanggal: " +
          new Date().toLocaleDateString("id-ID")
      );
    link.download = "tanda-terima-ktp.txt";
    link.click();
  };

  window.downloadSummary = () => {
    // Simulate PDF download
    const link = document.createElement("a");
    link.href =
      "data:application/pdf;base64,JVBERi0xLjQKJdPr6eEKMSAwIG9iago8PAovVGl0bGUgKFJpbmdrYXNhbiBQZW5nYWp1YW4gS1RQKQ==";
    link.download = "ringkasan-pengajuan-ktp.pdf";
    link.click();
  };

  window.trackApplication = () => {
    alert("Fitur pelacakan status akan segera tersedia!");
    // In real implementation, this would redirect to tracking page
  };

  window.newApplication = () => {
    if (
      confirm(
        "Apakah Anda yakin ingin membuat pengajuan baru? Data saat ini akan dihapus."
      )
    ) {
      location.reload();
    }
  };
});
