import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.nio.charset.StandardCharsets;

public class ChinesePinyinProcessor {

	public static void main(String[] args) throws IOException {
		// UTF-8: false, UTF-16: true
		boolean eost = true;
		// Testing mode
		boolean testingMode = false;
		long start = System.currentTimeMillis();
		BufferedReader br = new BufferedReader ( new InputStreamReader ( new FileInputStream( eost ? "Unihan_Readings16.txt" : "Unihan_Readings.txt" ), StandardCharsets.UTF_8 ) );
		StringBuilder sb = new StringBuilder();
		if ( testingMode ) {
			while ( true ) {
				String line = br.readLine();
				if ( line.contains( "kMandarin" ) ) {
					System.out.println("a");
					int uc = Integer.parseInt( line.substring(2, eost ? 7 : 6), 16 );
					char ch = Character.toChars( uc )[0];
					System.out.println( ch );
					System.out.println( line.substring( eost ? 18 : 17 ) );
					break;
				}
			}
		} else {
			sb.append("{\n");
			while ( true ) {
				String line = br.readLine();
				if ( line == null ) {
					break;
				}
				if ( line.contains("kMandarin") ) {
					sb.append( "\"" );
					int uc = Integer.parseInt( line.substring(2, eost ? 7 : 6), 16 );
					char ch = Character.toChars( uc )[0];
					sb.append( ch + "\":\"" );
					sb.append( line.substring( eost ? 18 : 17 ) + "\",\n" );
				}
			}
			sb.append("}");
			PrintWriter writer = new PrintWriter( eost ? "chinesepinyin16.txt" : "chinesepinyin.txt", eost ? "UTF-16" : "UTF-8");
			writer.println( sb );
			writer.close();
		}
		br.close();
		long end = System.currentTimeMillis();
		long diff = end - start;
		System.out.println( "Done in " + diff + "ms" );
	}

}
