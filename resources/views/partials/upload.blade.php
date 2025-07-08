<div class="container mx-auto px-4 mb-5">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Upload Medical Report</h2>

            <div class="flex items-start gap-4 bg-blue-50 rounded-lg p-4 mb-6">
                <!-- WhatsApp Icon Button -->
                <div class="flex flex-col items-center">
                    <a href="https://wa.me/+923158274326"
                       target="_blank"
                       class="whatsapp-btn bg-green-500 text-white p-3 rounded-full">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                    <span class="text-xs text-gray-600 mt-1">Click to Chat</span>
                </div>

                <!-- Information Note -->
                <div class="flex-1">
                    <p class="text-gray-700">
                        <strong class="text-blue-600">Free Expert Analysis:</strong><br>
                        We offer free, expert-based analysis of your first medical lab report —
                        such as blood tests, urine tests, CT scans, MRIs, and more —
                        helping you understand your health in simple, clear language.
                    </p>
                </div>
            </div>

            <!-- Report Upload Form -->
            {{-- <form action="{{ route('medical-reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2" for="report">Upload Medical Report</label>
                    <input type="file" name="report" id="report" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Submit Report
                </button>
            </form> --}}
        </div>
    </div>
