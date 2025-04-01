<?php

use App\Core\RequestObject;
/**
 * Example controller demonstrating how to handle notifications and render a view
 */
class ExampleController
{
    /**
     * Handles the example method logic and passes data to the view
     *
     * @param RequestObject $request Current request information
     * @return void
     */
    public function exampleMethod(RequestObject $request): void
    {
        // Collect notifications
        $notifications = $this->getNotifications();

        // Add additional business logic notifications
        if ($this->isOperationSuccessful()) {
            $notifications['success'][] = 'Operation completed successfully!';
        }

        if ($this->hasErrorOccurred()) {
            $notifications['error'][] = 'There was an error processing your request.';
        }

        // Render the view with the collected data
        echo $this->render('example/view', [
            'request' => $request,
            'notifications' => $notifications,
            'someData' => 'Example data for the view',
        ]);
    }

    /**
     * Retrieves success and error notifications from query parameters
     *
     * @return array An array containing success and error messages
     */
    private function getNotifications(): array
    {
        $notifications = [
            'success' => [],
            'error' => [],
        ];

        if (isset($_GET['success'])) {
            $notifications['success'][] = urldecode($_GET['success']);
        }

        if (isset($_GET['error'])) {
            $notifications['error'][] = urldecode($_GET['error']);
        }

        return $notifications;
    }

    /**
     * Simulates a condition to check if an operation was successful
     *
     * @return bool
     */
    private function isOperationSuccessful(): bool
    {
        // Replace with actual business logic
        return true;
    }

    /**
     * Simulates a condition to check if an error occurred
     *
     * @return bool
     */
    private function hasErrorOccurred(): bool
    {
        // Replace with actual business logic
        return false;
    }

    /**
     * Renders a view with the provided data
     *
     * @param string $viewPath Path to the view file
     * @param array $data Data to pass to the view
     * @return string Rendered view content
     */
    private function render(string $viewPath, array $data): string
    {
        // Simulate rendering logic (replace with actual implementation)
        return "Rendering view: {$viewPath} with data: " . json_encode($data);
    }
}