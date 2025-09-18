<style>
        .styled-element {
            width: 400px;
            padding: 15px;
            border: 2px solid #4CAF50;
            /* Green border */
            border-radius: 8px;
            background-color: #e8f5e9;
            /* Light green background */
            color: #2e7d32;
            /* Dark green text */
            font-size: 16px;
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Slight shadow for depth */
        }

        .styled-element:focus {
            border-color: #388e3c;
            /* Darker green border on focus */
            box-shadow: 0 0 5px rgba(56, 142, 60, 0.8);
            /* Green glow on focus */
        }

        .styled-button {
            cursor: pointer;
            text-align: center;
            display: inline-block;
            padding: 15px 30px;
            /* Adjust padding for buttons */
            background-color: #4CAF50;
            /* Green background */
            color: white;
        }

        .styled-button:hover {
            background-color: #388e3c;
            /* Darker green background on hover */
        }

        .custom-select {
            width: 200px;
            padding: 15px;
            border: 2px solid #4CAF50;
            /* Green border */
            border-radius: 8px;
            background-color: #e8f5e9;
            /* Light green background */
            color: #2e7d32;
            /* Dark green text */
            font-size: 16px;
            outline: none;
            -webkit-appearance: none;
            /* Remove default arrow in WebKit browsers */
            -moz-appearance: none;
            /* Remove default arrow in Firefox */
            appearance: none;
            /* Remove default arrow in other browsers */
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="%232e7d32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><path d="M6 9l6-6 6 6"></path></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
        }

        .green-textarea {
            width: 100%;
            height: 200px;
            padding: 15px;
            border: 2px solid #4CAF50;
            /* Green border */
            border-radius: 8px;
            background-color: #e8f5e9;
            /* Light green background */
            color: #000;
            /* Dark green text 2e7d32 */
            font-size: 18px;
            resize: none;
            /* Prevent resizing */
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Slight shadow for depth */
        }

        .green-textarea:focus {
            border-color: #388e3c;
            /* Darker green border on focus */
            box-shadow: 0 0 5px rgba(56, 142, 60, 0.8);
            /* Green glow on focus */
        }
    </style>
