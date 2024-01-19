public class DisplayMessages {

    public static void main(String[] args) {
        // Thread for "Good Morning" every second
        Thread thread1 = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    System.out.println("Good Morning");
                    try {
                        Thread.sleep(1000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });

        // Thread for "Hello" every two seconds
        Thread thread2 = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    System.out.println("Hello");
                    try {
                        Thread.sleep(2000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });

        // Thread for "Welcome" every three seconds
        Thread thread3 = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    System.out.println("Welcome");
                    try {
                        Thread.sleep(3000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });

        // Start threads
        thread1.start();
        thread2.start();
        thread3.start();
    }
}
